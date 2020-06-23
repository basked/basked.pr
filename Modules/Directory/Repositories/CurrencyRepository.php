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

//https://www.kantor.pl/_current-2.php
    private static function setProxy(Curl $curl)
    {
        $curl->setProxy('172.16.15.33', '3128', 'gt-asup6', 'teksab');
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
//#mw-content-text > div > table:nth-child(13) > tbody > tr:nth-child(1) > td:nth-child(1) > span > span > a > span
            $data = $crawler->filter('#mw-content-text > div > table')->eq(0)->filter('tbody>tr')->each(function (Crawler $node, $i) {
                return [
                    'country_id' => $node->filter('td>a')->attr('title'),
                   /*    'name' => trim($node->eq(1)->text()),
                   'emission_center' => trim($node->eq(3)->text()),
                      'symbol' => trim($node->eq(4)->text()),
                       'sample_url' => trim($node->eq(5)->text()),
                     'iso_name' =>trim($node->eq(6)->text()),
                       'iso_code' =>trim($node->eq(7)->text()),
              'iso_code_name' =>trim($node->eq(8)->text()),
                     'currency_unit' => trim($node->eq(9)->text()),
                     'currency_unit_sample_url' => trim($node->eq(10)->text()),*/
                      ];

            });
            $res_data = collect($data);
            return $res_data->filter(null);
        }
    }

    public static function reloadDataSite(): bool
    {
        // TODO: Implement reloadDataSite() method.
    }
}

