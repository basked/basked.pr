<?php


namespace Modules\Directory\Repositories\Interfaces;


use Illuminate\Support\Collection;

interface CurrencyRepositoryInterface
{
    /*
     * Данные из интернета по континентам
     *
     * */
    public static function getDataSite():Collection;
    public static function reloadDataSite() :bool ;

    /** Преобразовать данные (привести в нормальный вид по ссылкам, правка URL...) после загрузки в БД
     * @param Collection $data
     * @return Collection
     */
    public static function castingData();

}
