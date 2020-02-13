<?php


namespace Modules\Directory\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CountryRepositoryInterface
{
    public function all();

    public function getCountry($id);

    /*
     * Данные из интернета по континентам
     *
     * */
    public static function getDataSite(): Collection;

    public static function getDetailsDataSite(Model $model): Collection;

    public static function getAttributesDataSite(Model $model): Collection;

    public static function reloadDataSite(): bool;

}
