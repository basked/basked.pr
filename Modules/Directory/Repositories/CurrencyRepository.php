<?php


namespace Modules\Directory\Repositories;


use Illuminate\Support\Collection;
use Modules\Directory\Entities\Country\Country;
use Modules\Directory\Entities\Country\Details;
use Modules\Directory\Repositories\Interfaces\CurrencyRepositoryInterface;


use Curl\Curl;
use Exception;

use Illuminate\Support\Facades\DB;
use Modules\Directory\Entities\Currency;
use Modules\Directory\Repositories\Interfaces\UnitRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    private const BASE_URL = 'https://ru.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA_%D1%81%D1%83%D1%89%D0%B5%D1%81%D1%82%D0%B2%D1%83%D1%8E%D1%89%D0%B8%D1%85_%D0%B2%D0%B0%D0%BB%D1%8E%D1%82';
    private static $errors = [];

    private static function setProxy(Curl $curl)
    {
        $curl->setProxy('172.16.15.33', '3128', 'gt-asup6', 'teksab');
    }


    private static function getDataFromUrl(Crawler $node, $row, $pos, bool $isLink = false)
    {
        try {
            if ($isLink) {
                $res = 'https://ru.wikipedia.org' . trim($node->filter('td')->eq($pos)->filter('a')->attr('href'), " \t\n\r\0\x0B\xC2\xA0");
            } else {
                $res = trim($node->filter('td')->eq($pos)->text(), " \t\n\r\0\x0B\xC2\xA0");
            }
        } catch (Exception $e) {
            self::$errors[sizeof(self::$errors) + 1] = 'Строка №' . $row . ' Позиция #' . $pos . '. ' . $e->getMessage();
            $res = '';
        }
        return $res;
    }


    public static function getDataSite(): Collection
    {
        ini_set('max_execution_time', 1200);
        $curl = new Curl();
        $curl->setTimeout(1200);
        if (gethostname() == 'gt-asup6nv') {
            self::setProxy($curl);
        };
        $curl->get(self::BASE_URL);
        if ($curl->error) {
            echo 'Ошибка при парсинге в функции https://ru.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA_%D1%81%D1%83%D1%89%D0%B5%D1%81%D1%82%D0%B2%D1%83%D1%8E%D1%89%D0%B8%D1%85_%D0%B2%D0%B0%D0%BB%D1%8E%D1%82: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $crawler = new Crawler($curl->response);
            $data = $crawler->filter('#mw-content-text > div>table:nth-child(13)>tbody>tr')->each(function (Crawler $node, $i) {
                if ($i > 1) {
                    $n = self::getDataFromUrl($node, $i, 0, false);
                    $n = trim($n);
                    return [
                        'country_id' => CountryRepository::getIdFromNameCountry($n),
                        'name' => self::getDataFromUrl($node, $i, 1, false),
                        'emission_center' => self::getDataFromUrl($node, $i, 2, false),
                        'symbol' => self::getDataFromUrl($node, $i, 3, false),
                        'sample_url' => self::getDataFromUrl($node, $i, 0, true),
                        'iso_name' => self::getDataFromUrl($node, $i, 5, false),
                        'iso_code' => self::getDataFromUrl($node, $i, 6, false),
                        'iso_code_name' => self::getDataFromUrl($node, $i, 7, false),
                        'currency_unit' => self::getDataFromUrl($node, $i, 8, false),
                        'currency_unit_sample_url' => self::getDataFromUrl($node, $i, 10, true),
                        'descr' => $n,
                    ];
                }
            });
            return collect(json_decode(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE)));;
        }
    }


    // reload data
    public static function reloadDataSite(): bool
    {
        try {
            // Delete all records
            DB::table('spr_currencies')->delete();
            // Begin value generator with 1
            DB::statement('ALTER TABLE spr_currencies AUTO_INCREMENT = 1');
            $currencies = Currency::getCurrencySite()->sortBy('descr');
            $currencies->each(function ($item, $key) {
                if (!is_null($item)) {
                    $currency = new Currency([
                        'country_id' => $item->country_id,
                        'name' => $item->name,
                        'emission_center' => $item->emission_center,
                        'symbol' => $item->symbol,
                        'sample_url' => $item->sample_url,
                        'iso_name' => $item->iso_name,
                        'iso_code' => $item->iso_code,
                        'iso_code_name' => $item->iso_code_name,
                        'currency_unit' => $item->currency_unit,
                        'currency_unit_sample_url' => $item->currency_unit_sample_url,
                        'descr' => $item->descr,
                    ]);
                    $currency->save();
                }
            });
            // отредакимруем недостающие данные

            self::castingData();
        } catch (Exception $e) {
            echo 'Выброшено исключение при перегрузке данных сайта: ', $e->getMessage(), "<br>";
            return false;
        }
        return true;
    }


    /**
     * @inheritDoc
     */
    public static function castingData()
    {
        // Даннаые которые необходимо отредактировать в даблице
        $emptyCountryID = [
            ['name_curr' => 'ОАЭ', 'name' => 'Объединённые Арабские Эмираты', 'country_id' => 133],
            ['name_curr' => 'Остров Буве', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Остров Норфолк', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Остров Рождества', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Херд и Макдональд', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Аландские острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Теркс и Кайкос', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Государство Палестина', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Американское Самоа', 'name' => 'Самоа', 'country_id' => 150],
            ['name_curr' => 'Ангилья', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Папуа — Новая Гвинея', 'name' => 'Папуа-Новая Гвинея', 'country_id' => 139],
            ['name_curr' => 'Антарктида', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Острова Питкэрн', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Пуэрто-Рико', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Багамские Острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Саба', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Белоруссия', 'name' => 'Беларусь', 'country_id' => 17],
            ['name_curr' => 'Остров Святой Елены Остров Вознесения Тристан-да-Кунья[26]', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Бонэйр', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Северные Марианские острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Сейшельские Острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Сен-Бартелеми', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Сен-Мартен', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Британская территория в Индийском океане', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Буркина-Фасо', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Сен-Пьер и Микелон', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Сербия', 'name' => 'Сербия', 'country_id' => 211],
            ['name_curr' => 'Синт-Мартен', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Синт-Эстатиус', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Британские Виргинские острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Американские Виргинские острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'США', 'name' => '	Соединённые Штаты Америки', 'country_id' => null],
            ['name_curr' => 'Гваделупа', 'name' => 'Гваделупа', 'country_id' => null],
            ['name_curr' => 'Китайская Республика', 'name' => 'Китай', 'country_id' => null],
            ['name_curr' => 'Гернси', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Туркмения', 'name' => 'Туркменистан', 'country_id' => null],
            ['name_curr' => 'Гуам', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Джерси', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Уоллис и Футуна', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Фарерские острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Евросоюз', 'name' => 'Евросоюз', 'country_id' => 213],
            ['name_curr' => 'Западная Сахара', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Фолклендские острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Гвиана', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Французские Южные и Антарктические территории', 'name' => '', 'country_id' => null],
            ['name_curr' => 'ЦА', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Черногория', 'name' => 'Черногория', 'country_id' => 214],
            ['name_curr' => 'Шпицберген и Ян-Майен', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Острова Кайман', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Эсватини', 'name' => '', 'country_id' => null],
            ['name_curr' => 'ЮА', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Киргизия', 'name' => 'Кыргызстан', 'country_id' => 92],
            ['name_curr' => 'Южная Георгия и Южные Сандвичевы острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Кокосовые острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Республика Конго', 'name' => '	Конго', 'country_id' => 86],
            ['name_curr' => 'ДР Конго', 'name' => '', 'Демократическая Республика Конго' => 55],
            ['name_curr' => 'КНДР', 'name' => 'Северная Корея', 'country_id' => 207],
            ['name_curr' => 'Республика Корея', 'name' => 'Южная Корея', 'country_id' => 155],
            ['name_curr' => 'Кот-д’Ивуар', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Кюрасао', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Майотта', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Северная Македония', 'name' => 'Македония', 'country_id' => 106],
            ['name_curr' => 'Внешние малые острова', 'name' => '', 'country_id' => null],
            ['name_curr' => 'Маршалловы Острова', 'name' => '', 'country_id' => null],
        ];
        try{


        foreach ($emptyCountryID as $country) {
            if (!is_null($country["name_curr"])) {

//                $currency = Currency::where('descr',$country['name_curr'])->getModel();
//                $currency->update(['country_id'=>CountryRepository::getIdFromNameCountry($country['name'])]);
//                $currency->name= "yyy";
//                $currency->country_id=CountryRepository::getIdFromNameCountry( $country['name']);
//                $currency->descr= $country['name'];
//                $currency->save();



//                dd($country['name_curr'],$country['name'], $currency );

//                $currency->country_id=CountryRepository::getIdFromNameCountry( $country['name']);
//                $currency->descr= $country['name'];
//                $currency->save();
            }

        }
        } catch (Exception $e){
            echo $e->getMessage();
        }

    }
}

