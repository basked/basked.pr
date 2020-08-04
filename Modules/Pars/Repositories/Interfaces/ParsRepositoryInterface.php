<?php


namespace Modules\Pars\Repositories;


use Illuminate\Support\Collection;

interface ParsRepositoryInterface
{
 // коллекция данных из сайта
 public static function getDataSite():Collection;

}
