<?php

namespace Modules\Directory\Repositories;

use Modules\Directory\Entities\Continent;
use Modules\Directory\Repositories\Interfaces\ContinentRepositoryInterface;
use Curl\Curl;
use Curl\MultiCurl;
use Symfony\Component\DomCrawler;
use Symfony\Component\DomCrawler\Crawler;


class ContinentRepository implements ContinentRepositoryInterface
{
    const BASE_URL='https://gtmarket.ru/' ;

    public function all()
    {
        return Continent::all()->toArray();
    }

    public function getContintnent($id)
    {
        return json_decode(Continent::find($id)->toJson(), JSON_UNESCAPED_UNICODE);
    }

    /**
     * Данные из интернета по континентам
     */
    static public function setProxy(Curl $curl)
    {
        $curl->setProxy('172.16.15.33', '3128', 'gt-asup6', 'teksab');
    }

    public function getContinentData()
    {
        $curl = new Curl();
        if (gethostname()=='gt-asup6nv') {
            self::setProxy($curl);
        };
        $curl->get( self::BASE_URL.'countries/');
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
