<?php


namespace Modules\Directory\Repositories\Interfaces;
use Illuminate\Support\Collection;

interface CountryRepositoryInterface
{
    public function all();
    public function getCountry($id);
    /*
     * Данные из интернета по континентам
     *
     * */
    public static function getCountryData() :Collection;
    public static function reloadCountryData() :bool ;

}
