<?php


namespace Modules\Directory\Repositories\Interfaces;


interface CountryRepositoryInterface
{
    public function all();
    public function getCountry($id);
    /*
     * Данные из интернета по континентам
     *
     * */
    public function getCountryData();
}
