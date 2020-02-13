<?php
namespace Modules\Skill\Repositories;

use Modules\Skill\Repositories\Interfaces\TechnologyRepositoryInterface;
use Curl\Curl;
use Symfony\Component\DomCrawler\Crawler;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Skill\Entities\Technology;


class TechnologyRepository implements TechnologyRepositoryInterface
{
    private const BASE_URL = 'https://www.tiobe.com';

    private static function setProxy(Curl $curl)
    {
        $curl->setProxy('172.16.15.33', '3128', 'gt-asup6', 'teksab');
    }

    public static function getDataSite(): Collection
    {

        ini_set('max_execution_time', 1200);
        $curl = new Curl();
        $curl->setTimeout(1200);
        // $curl->setConcurrency(20);
        if (gethostname() == 'gt-asup6nv') {
            self::setProxy($curl);
        };
        $curl->get(self::BASE_URL . '/tiobe-index/programming-technologies-definition/');
        if ($curl->error) {
            echo 'Ошибка при парсинге в функции https://gtmarket.ru/countries/: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            $crawler = new Crawler($curl->response);
            $data = $crawler->filter('body > section > section > section > article > ul')->eq(5)->filter('li')->each(function (Crawler $node, $i) {
                return [
                    'name' => trim($node->filter('li')->text()),
                    'slug' =>Str::slug(trim($node->filter('li')->text())),
                    'descr'=>'Description for '. trim($node->filter('li')->text())
                ];
            });
            return collect($data);
        }

    }

    public static function reloadDataSite(): bool
    {
        try {
            // Delete all records
            DB::table('sk_types')->delete();
            // Begin value generator with 1
            DB::statement('ALTER TABLE sk_technologies AUTO_INCREMENT = 1');
              $technologies= Technology::getTechnologiesSite()->sortBy('name');
            $technologies->each(function ($item, $key) {
                $technology = new Technology([
                    'name' => $item['name'],
                    'slug' => Str::slug( $item['name']),
                    'descr' => $item['descr'],
                ]);
                $technology->save();
            });
        } catch (Exception $e) {
            echo 'Выброшено исключение при перегрузке данных сайта: ', $e->getMessage(), "<br>";
            return false;
        }
        return true;
    }
}
