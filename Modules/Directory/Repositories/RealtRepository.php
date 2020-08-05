<?php


namespace Modules\Directory\Repositories;

use Carbon\Carbon;
use Curl\Curl;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Directory\Entities\Unit;
use Modules\Directory\Repositories\Interfaces\RealtRepositoryInterface;
use Modules\Directory\Repositories\Interfaces\UnitRepositoryInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\DomCrawler\Crawler;
use function Sodium\add;

class RealtRepository implements RealtRepositoryInterface
{
    private const BASE_URL = 'https://a-brest.by';

    private static function setProxy(Curl $curl)
    {
        $curl->setProxy('172.16.15.33', '3128', 'gt-asup6', 'teksab');
    }

    /*
     * Удаляет абреввиатуру валют
     */
    private static function del_name_val($s): int
    {
        $vals = ['BYN', 'USD', 'EUR', 'RUB'];
        foreach ($vals as $val) {
            $s = trim(str_replace($val, '', str_replace(' ', '', $s)));
        }
        return (int)$s;
    }


    private static function getDataDetail(String $url): array
    {
        ini_set('max_execution_time', 1200);
        $curl = new Curl();
        $curl->setTimeout(1200);
        if (gethostname() == 'gt-asup6nv') {
            self::setProxy($curl);
        };

        $res_data = array();
        $curl->get($url);
        if ($curl->error) {
            echo 'Ошибка при парсинге в функции' . $url . ':' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $crawler = new Crawler($curl->response);
            $crawler->filter('dl.line-prop')->each(function (Crawler $node, $i) use (&$res_data) {
                array_push($res_data, [
                    /*характиристики*/
                    'code_obj' => $node->filter('dd')->eq(0)->text(),
                    'type_obj' => $node->filter('dd')->eq(1)->text(),
                    'type_sentence' => $node->filter('dd')->eq(2)->text(),
                    'location' => [
                        'region' => $node->filter('dd')->eq(4)->text(),
                        'village_council' => $node->filter('dd')->eq(5)->text(),
                        'route' => $node->filter('dd')->eq(6)->text(),
                        'distance_city' => $node->filter('dd')->eq(8)->text(),
                        'driveways' => $node->filter('dd')->eq(9)->text(),
                        'railway_message' => $node->filter('dd')->eq(10)->text()
                    ],
                    'land_area' => $node->filter('dd')->eq(17)->text(),
                    'type_right' => $node->filter('dd')->eq(18)->text(),
                ]);
            });
            $res_data['description']= $crawler->filter('div.dt-content')->text();
            return $res_data;
        }
    }


    // данные конктретной страницы с листом объектов парсинга
    //
    private static function getPageData(String $url): array
    {
        ini_set('max_execution_time', 1200);
        $curl = new Curl();
        $curl->setTimeout(1200);
        if (gethostname() == 'gt-asup6nv') {
            self::setProxy($curl);
        };

        $res_data = array();
        $curl->get($url);
        if ($curl->error) {
            echo 'Ошибка при парсинге в функции' . $url . ':' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $crawler = new Crawler($curl->response);
            $crawler->filter('.ctl-g-item')->each(function (Crawler $node, $i) use (&$res_data) {
                $node_valutes = $node->filter('.ctl-g-link-w')->filter('a');
                $node_area = $node->filter('.g-props.flex')->filter('.g-p-i');
                $node_content = $node->filter('.g-content');
                $area = '';
                array_push($res_data, [
                    /*общая инфа*/
                    'code' => (int)trim(str_replace('Код объекта - ', '', $node_content->filter('.g-c-item.g-c-code')->text())),
                    'type' => trim($node_content->filter('.g-c-item.g-c-type')->text()),
                    'usd' => self::del_name_val($node_valutes->filter('div.g-img > div.g-cost-w > div > span.g-cost-other')->attr('data-usd')),
                    'area_info' => [
                        'area' => $node_area->filter('.g-p-item')->eq(0)->text(),
                        'floor' => $node_area->filter('.g-p-item')->eq(1)->text(),
                        'sotka' => $node_area->filter('.g-p-item')->eq(2)->text()
                    ],
                    'location' => trim($node_content->filter('.g-c-moby-loc')->attr('data-loc')),
                    'coord' => $node->filter('.ctl-g-link-w')->filter('.h-mp-text')->filter('a')->attr('data-coordinates'),
                    // ссылка на сайте,   координаты , картинка
                    'url' => self::BASE_URL . $node->filter('.ctl-g-link-w')->filter('a')->attr('href'),

                    'img' => self::BASE_URL . $node->filter('picture')->filter('img')->attr('data-src'),
                    'location_img' => $node->filter('picture')->filter('img')->attr('data-src'),
                    /*стоимость*/
                    'price' => [
                        'date' => Carbon::now()->toDateTimeString(),
                        'cost' => ['byn' => self::del_name_val($node_valutes->filter('div.g-img > div.g-cost-w > div > span.g-cost-byn')->text()),
                            'usd' => self::del_name_val($node_valutes->filter('div.g-img > div.g-cost-w > div > span.g-cost-other')->attr('data-usd')),
                            'euro' => self::del_name_val($node_valutes->filter('div.g-img > div.g-cost-w > div > span.g-cost-other')->attr('data-eur')),
                            'rub' => self::del_name_val($node_valutes->filter('div.g-img > div.g-cost-w > div > span.g-cost-other')->attr('data-rub'))],
                    ]]);
            });
        };
        return $res_data;
    }

    public static function getDataSite(): Collection
    {
        /*  -- тут все работает
        $data_res = new Collection();
        $data_res->add(self::getPageData(self::BASE_URL . '/catalog/dachi-uchastki/uchastki/'));
        for ($i = 2; $i <= 10; $i++) {
            $data_res->add(self::getPageData(self::BASE_URL . '/catalog/dachi-uchastki/uchastki/?PAGEN_1=' . $i));
        }
        // return $res_data->pluck('data')->pluck('data')->where('price.cost.usd', '<=', 10000)->sortBy('code')->unique()->values()->collect();
        // return $data_res->collapse()->where('price.cost.usd', '<=', 10000)->sortBy('price.cost.usd')->unique()->values()->collect();
        return $data_res->collapse()->where('price.cost.usd', '<=', 12000)->filter(function ($value, $key) {
            return strpos($value['location'], 'омач');
        })->sortBy('price.cost.usd')->unique()->values()->collect();*/



        $data_res = new Collection();
        $data_res->add(self::getDataDetail(self::BASE_URL . '/catalog/dachi-uchastki/200904/'));
       dd($data_res);
    }

    public static function reloadDataSite(): bool
    {
        // TODO: Implement reloadDataSite() method.
    }
}

