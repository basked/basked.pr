<?php


namespace Modules\Directory\Repositories;

use Curl\Curl;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Directory\Entities\Unit;
use Modules\Directory\Repositories\Interfaces\UnitRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;

class UnitRepository implements UnitRepositoryInterface
{
    private const BASE_URL = 'https://classifikators.ru/';

    private static function setProxy(Curl $curl)
    {
        $curl->setProxy('172.16.15.33', '3128', 'gt-asup6', 'teksab');
    }


    /**
     * Return collection data from site
     * @return Collection
     * */
    public static function getDataSite(): Collection
    {
        ini_set('max_execution_time', 1200);
        $curl = new Curl();
        $curl->setTimeout(1200);
        if (gethostname() == 'gt-asup6nv') {
            self::setProxy($curl);
        };
        $curl->get(self::BASE_URL . '/okei/');
        if ($curl->error) {
            echo 'Ошибка при парсинге в функции https://classifikators.ru/okei/: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $crawler = new Crawler($curl->response);
            $gr = '';
//            Международные единицы измерения, включенные в ОКЕИ
            $data = $crawler->filter('#international > table > tbody > tr')->each(function (Crawler $node, $i) use (&$gr) {
                if ($node->filter('td')->eq(0)->attr('class') == 'td-title td-border-top') {
                    $gr = $node->text();
                } else {
                    return [
                        'code' => $node->filter('td')->eq(1)->text(),
                        'name' => $node->filter('td')->eq(2)->text(),
                        'symbol_national' => $node->filter('td')->eq(3)->text(),
                        'symbol_intern' => $node->filter('td')->eq(4)->text(),
                        'code_national' => $node->filter('td')->eq(5)->text(),
                        'code_intern' => $node->filter('td')->eq(6)->text(),
                        'section' => 'international_units',
                        'unit_group' => $gr
                    ];
                }
            });
//            Национальные единицы измерения, включенные в ОКЕИ
            $data2 = $crawler->filter('#national > table > tbody > tr')->each(function (Crawler $node, $i) use (&$gr) {
                if ($node->filter('td')->eq(0)->attr('class') == 'td-title td-border-top') {
                    $gr = $node->text();
                } else {
                    return [
                        'code' => $node->filter('td')->eq(1)->text(),
                        'name' => $node->filter('td')->eq(2)->text(),
                        'symbol_national' => $node->filter('td')->eq(3)->text(),
                        'symbol_intern' => '',
                        'code_national' => $node->filter('td')->eq(4)->text(),
                        'code_intern' => '',
                        'section' => 'national_units',
                        'unit_group' => $gr
                    ];
                }
            });
//            Четырехзначные национальные единицы измерения, включенные в ОКЕИ
            $data3 = $crawler->filter('#national4 > table > tbody > tr')->each(function (Crawler $node, $i) use (&$gr) {
                if ($node->filter('td')->eq(0)->attr('class') == 'td-title td-border-top') {
                    $gr = $node->text();
                } else {
                    return [
                        'code' => $node->filter('td')->eq(1)->text(),
                        'name' => $node->filter('td')->eq(2)->text(),
                        'symbol_national' => $node->filter('td')->eq(3)->text(),
                        'symbol_intern' => '',
                        'code_national' => $node->filter('td')->eq(4)->text(),
                        'code_intern' => '',
                        'section' => 'national4_units',
                        'unit_group' => $gr
                    ];
                }
            });
//           Международные единицы измерения, не включенные в ОКЕИ
            $data4 = $crawler->filter('#national4 > table > tbody > tr')->each(function (Crawler $node, $i) use (&$gr) {
                if ($node->filter('td')->eq(0)->attr('class') == 'td-title td-border-top') {
                    $gr = $node->text();
                } else {
                    return [
                        'code' => $node->filter('td')->eq(1)->text(),
                        'name' => $node->filter('td')->eq(2)->text(),
                        'symbol_national' => '',
                        'symbol_intern' => $node->filter('td')->eq(3)->text(),
                        'code_national' => '',
                        'code_intern' => $node->filter('td')->eq(4)->text(),
                        'section' => 'international_no_okea_units',
                        'unit_group' => $gr
                    ];
                }
            });
            $res_data = collect($data)->merge($data2)->merge($data3)->merge($data4);
            return $res_data->filter(null);
        }
    }

    public static function reloadDataSite(): bool
    {
        try {
            // Delete all records
            DB::table('spr_units')->delete();

            // Begin value generator with 1
            DB::statement('ALTER TABLE spr_units AUTO_INCREMENT = 1');

            $units = Unit::getUnitsSite()->sortBy('unit_group');
            $units->each(function ($item, $key) {
                $unit = new Unit([
                    'code' => $item['code'],
                    'name' => $item['name'],
                    'symbol_national' => $item['symbol_national'],
                    'symbol_intern' => $item['symbol_intern'],
                    'code_national' => $item['code_national'],
                    'code_intern' => $item['code_intern'],
                    'section' => $item['section'],
                    'unit_group' => $item['unit_group'],
                ]);
                $unit->save();
            });
        } catch (Exception $e) {
            echo 'Выброшено исключение при перегрузке данных по единицам учета с сайта: ', $e->getMessage(), "<br>";
            return false;
        }
        return true;
    }


}
