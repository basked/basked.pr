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
            try {
                $crawler = new Crawler($curl->response);
                $crawler->filter('dl.line-prop')->each(function (Crawler $node, $i) use (&$res_data) {
                    /*характиристики*/
                    for ($p = 0; $p <= $node->filter('dt')->count() - 1; $p++) {
                        switch (self::getNodeText($node->filter('dt')->eq($p))) {
                            case "Код объекта":
                                $res_data['code_obj'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Вид объекта":
                                $res_data['type_obj'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Тип предложения":
                                $res_data['type_sentence'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Населенный пункт":
                                $res_data['location']['inhabited_locality'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Часть города":
                                $res_data['location']['part_city'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Микрорайон":
                                $res_data['location']['microdistrict'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Район":
                                $res_data['location']['region'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Сельсовет":
                                $res_data['location']['village_council'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Направление":
                                $res_data['location']['route'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "От черты г. Бреста":
                                $res_data['location']['distance_city'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Подъездные пути":
                                $res_data['location']['driveways'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Ж/д сообщение":
                                $res_data['location']['railway_message'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Площадь участка":
                                $res_data['land_area'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Вид права на землю":
                                $res_data['type_right'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Вид фундамента":
                                $res_data['foundation']['type'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Материал фундамента":
                                $res_data['foundation']['material'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Подушка фундамента":
                                $res_data['foundation']['cushion'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Газ":
                                $res_data['gas'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Электричество":
                                $res_data['electric'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                            case "Вода":
                                $res_data['water'] = self::getNodeText($node->filter('dd')->eq($p));
                                break;
                        }
                    }
                });

                $crawler->filter('.swiper-wrapper.lightgallery>a')->each(function (Crawler $node, $i) use (&$res_data) {
                    $res_data['imgs'][] = self::BASE_URL . $node->attr('data-src');
                });

                $res_data['description'] = self::getNodeText($crawler->filter('div.dt-wrap'));
            } catch (Exception $e) {
                echo '<br>' . 'Выброшено исключение Код =' . $res_data['code_obj'] . ' в getDataDetail: ', $e->getMessage(), "\n";
            }
            return $res_data;
        }
    }

    private static function getNodeText(Crawler $node): string
    {
        return $node->count() ? $node->text() : '';
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
            try {
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
                        ],
                        'detail_info' => self::getDataDetail(self::BASE_URL . $node->filter('.ctl-g-link-w')->filter('a')->attr('href'))
                    ]);
                });

            } catch (Exception $e) {
                echo '<br>' . 'Выброшено исключение для getPageData: ', $e->getMessage(), "\n";
            }
            return $res_data;
        }
    }


    public static function getDataSite(): Collection
    {
        /*  -- тут все работает*/
        $data_res = new Collection();
        $data_res->add(self::getPageData(self::BASE_URL . '/catalog/dachi-uchastki/uchastki/'));
        for ($i = 2; $i <= 10; $i++) {
            $data_res->add(self::getPageData(self::BASE_URL . '/catalog/dachi-uchastki/uchastki/?PAGEN_1=' . $i));
        }
        // return $res_data->pluck('data')->pluck('data')->where('price.cost.usd', '<=', 10000)->sortBy('code')->unique()->values()->collect();
        // return $data_res->collapse()->where('price.cost.usd', '<=', 10000)->sortBy('price.cost.usd')->unique()->values()->collect();
        return $data_res->collapse()->where('price.cost.usd', '<=', 12000)->filter(function ($value, $key) {
            return strpos($value['location'], 'омач');
        })->sortBy('price.cost.usd')->unique()->values()->collect();

        /*
                $data_res = new Collection();
                $data_res->add(self::getDataDetail(self::BASE_URL . '/catalog/dachi-uchastki/202435/'));
                return $data_res;*/
    }

    public static function reloadDataSite(): bool
    {
        // TODO: Implement reloadDataSite() method.
    }
}

