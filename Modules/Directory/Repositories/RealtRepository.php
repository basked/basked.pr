<?php


namespace Modules\Directory\Repositories;

use Curl\Curl;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Directory\Entities\Unit;
use Modules\Directory\Repositories\Interfaces\RealtRepositoryInterface;
use Modules\Directory\Repositories\Interfaces\UnitRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;

class RealtRepository implements RealtRepositoryInterface
{
    private const BASE_URL = 'https://a-brest.by';

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
        $curl->get(self::BASE_URL . '/catalog/dachi-uchastki/uchastki/?PAGEN_1=2');
        if ($curl->error) {
            echo 'Ошибка при парсинге в функции' . self::BASE_URL . '/?PAGEN_1=2' . ':' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $crawler = new Crawler($curl->response);
            $gr = [];

            $data = $crawler->filter('.ctl-g-item')->each(function (Crawler $node, $i) {
                $node1 = $node->filter('.ctl-g-link-w')->filter('a');
                return [
                    'url' => $node->filter('.ctl-g-link-w')->filter('a')->attr('href'),
                    'coord' => $node->filter('.ctl-g-link-w')->filter('.h-mp-text')->filter('a')->attr('data-coordinates'),
                    'img' => self::BASE_URL . $node->filter('picture')->filter('img')->attr('data-src'),
                    'location' => $node->filter('picture')->filter('img')->attr('data-src'),
                    'byn' => $node1->filter('div.g-img > div.g-cost-w > div > span.g-cost-byn')->text(),
                    'usd' => $node1->filter('div.g-img > div.g-cost-w > div > span.g-cost-other')->attr('data-usd'),
                    'euro' => $node1->filter('div.g-img > div.g-cost-w > div > span.g-cost-other')->attr('data-eur'),
                    'rub' => $node1->filter('div.g-img > div.g-cost-w > div > span.g-cost-other')->attr('data-rub'),
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

