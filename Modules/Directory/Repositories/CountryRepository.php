<?php


namespace Modules\Directory\Repositories;

use Curl\Curl;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Directory\Entities\Country\Country;
use Modules\Directory\Entities\Country\Details;
use Modules\Directory\Repositories\Interfaces\CountryRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;

class CountryRepository implements CountryRepositoryInterface
{
    private const BASE_URL = 'https://gtmarket.ru';

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
        $curl->get(self::BASE_URL . '/countries/');
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
     * @Country $country
     * @return Collection
     * */
    public static function getCountryAttributesData(Country $country): Collection
    {
        $curl = new Curl();
        if (gethostname() == 'gt-asup6nv') {
            self::setProxy($curl);
        };
        // поиск по County аттрибутов
        $url = self::BASE_URL . $country->details->url;
        $curl->get($url);
        if ($curl->error) {
            echo "Ошибка при парсинге в функции ссылки $url" . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $crawler = new Crawler($curl->response);
            $data = $crawler->filter('#main >   article > div > table > thead > tr')->each(function (Crawler $node, $i) {
                if ($i > 2) {
                    return [
                        'label' => str_replace(html_entity_decode('&shy;'), '',  str_replace(':','',trim($node->filter('td.label')->text()))),
                        'content_key' => str_replace('.','',trim($node->filter('td.content')->attr('id'))),
                        'content_val' => str_replace('.','',trim($node->filter('td.content')->text())),
                    ];
                }
            });
            return collect($data);
        }
    }

    /**
     * Return collection data from site
     * @return bool
     **/
    public static function reloadCountryData(): bool
    {
        try {
            // Delete all records
            DB::table('spr_countries')->delete();
            DB::table('spr_countries_details')->delete();
            DB::table('spr_countries_attr')->delete();
            DB::table('spr_countries_attr_val')->delete();

            // Begin value generator with 1
            DB::statement('ALTER TABLE spr_countries AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE spr_countries_details AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE spr_countries_attr AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE spr_countries_attr_val AUTO_INCREMENT = 1');

            $countries = Country::getDataSite()->sortBy('name');
            $countries->each(function ($item, $key) {
                $country = new Country(['name' => $item['name']]);
                $country->save();
                $country->details()->save(new Details(['url' => $item['url']]));
            });
        } catch (Exception $e) {
            echo 'Выброшено исключение при перегрузке данных сайта: ', $e->getMessage(), "<br>";
            return false;
        }
        return true;
    }
}
