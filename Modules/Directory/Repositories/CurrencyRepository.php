<?php


namespace Modules\Directory\Repositories;


use Illuminate\Support\Collection;
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
                $res = 'https://ru.wikipedia.org' . strip_tags($node->filter('td')->eq($pos)->filter('a')->attr('href'));
            } else {
                $res = strip_tags($node->filter('td')->eq($pos)->text());
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
                    ];
                }
            });
            $res_data = collect($data);
            return $res_data->filter(null);
        }
    }


    // reload data
    public static function reloadDataSite(): bool
    {
        try {
            // Delete all records
            DB::table('spr_currency')->delete();
            // Begin value generator with 1
            DB::statement('ALTER TABLE spr_currency AUTO_INCREMENT = 1');
        } catch (Exception $e) {
            echo 'Выброшено исключение при перегрузке данных сайта: ', $e->getMessage(), "<br>";
            return false;
        }
        return true;
    }
}

