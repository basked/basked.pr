<?php


namespace Modules\Directory\Repositories;

use Curl\Curl;
use Modules\Directory\Entities\Country\Country;
use Modules\Directory\Repositories\Interfaces\CountryRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;

class CountryRepository implements CountryRepositoryInterface
{
    const BASE_URL = 'https://gtmarket.ru/';

    static public function setProxy(Curl $curl)
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

    public function getCountryData()
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
            return $data;
        }

    }

}
