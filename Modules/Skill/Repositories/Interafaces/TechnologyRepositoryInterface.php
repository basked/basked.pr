<?php


namespace Modules\Skill\Repositories\Interfaces;
use Illuminate\Support\Collection;

interface TechnologyRepositoryInterface
{

    /*
     * Данные из интернета по континентам
     *
     * */
    public static function getDataSite() :Collection;
    public static function reloadDataSite() :bool ;

}
