<?php


namespace Modules\Directory\Repositories\Interfaces;


use Illuminate\Support\Collection;

interface UnitRepositoryInterface
{
    /*
     * Данные из интернета по континентам
     *
     * */
    public static function getDataSite() :Collection;
    public static function reloadDataSite() :bool ;

}
