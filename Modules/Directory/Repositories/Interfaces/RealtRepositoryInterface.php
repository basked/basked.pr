<?php


namespace Modules\Directory\Repositories\Interfaces;


use Illuminate\Support\Collection;

interface RealtRepositoryInterface
{
    /*
   * Данные из интернета по континентам
   *
   * */
    public static function getDataSite():Collection;

    public static function reloadDataSite(): bool;
}

