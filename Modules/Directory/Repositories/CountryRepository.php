<?php


namespace Modules\Directory\Repositories;

use Curl\Curl;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Directory\Entities\Country\Country;
use Modules\Directory\Repositories\Interfaces\CountryRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;

class CountryRepository implements CountryRepositoryInterface
{
    private const BASE_URL = 'https://gtmarket.ru/';

    private static function setProxy(Curl $curl)
    {
        $curl->setProxy('172.16.15.33', '3128', 'gt-asup6', 'teksab');
    }

    public function all()
    {
        return Country::all()->toArray();
    }

    public function getCountry($id)
    {
        return Country::find($id)->toArray();
    }

    /**
     * Return collection data from site
     * @return Collection
     * */
    public static function getCountryData(): Collection
    {
        $curl = new Curl();
        if (gethostname() == 'gt-asup6nv') {
            self::setProxy($curl);
        };
        $curl->get(self::BASE_URL . 'countries/');
        if ($curl->error) {
            echo 'Ошибка при парсинге в функции https://gtmarket.ru/countries/: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $crawler = new Crawler($curl->response);
            $data = $crawler->filter('.items>ul>li')->each(function (Crawler $node, $i) {
                return [
                    'name' => trim($node->text()),
                    'url' => $node->filter('a')->attr('href'),
                ];
            });
            return collect($data);
        }

    }


    /**
     * Return collection data from site
     * @return bool
     **/
    public static function reloadCountryData():bool
    {
        try {
            // Delete all records
            DB::table('spr_countries')->delete();
            // Begin value generator with 1
            DB::statement('ALTER TABLE spr_countries AUTO_INCREMENT = 1');
            $countries = Country::getDataSite()->sortBy('name');
            $countries->each(function ($item, $key) {
                $country = new Country();
                $country->name = $item['name'];
                $country->save();
            });
        } catch (Exception $e) {
            echo 'Выброшено исключение при перегрузке данных сайта: ', $e->getMessage(), "<br>";
            return false;
        }
        return true;
    }
}
