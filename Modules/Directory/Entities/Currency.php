<?php

namespace Modules\Directory\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Directory\Repositories\CurrencyRepository;

class Currency extends Model
{
    protected $fillable = [];
    protected $table='spr_currencies';
    public static function getCurrencySite()
    {
        return CurrencyRepository::getDataSite();
    }

    public static function reloadUnitsSite()
    {
        return CurrencyRepository::reloadDataSite();
    }

    /**
     * Names columms for model
     * @return array
     */
    public static function getColumns()
    {
        return self::query()->getModel()->getFillable();
    }


    /**
     * Names columms with captions for model
     * @return array|string
     */
    public static function getColumnsWithCaptions()
    {
        $data = [];
        $columns = self::query()->getModel()->getFillable();
        foreach ($columns as $index => $column) {
            $ar['dataField'] = $column;
            $ar['caption'] = self::captions[$index];
            $data[$index] = $ar;
        }
        return json_encode($data);

    }
}
