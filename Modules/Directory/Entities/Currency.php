<?php

namespace Modules\Directory\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Directory\Repositories\CurrencyRepository;

/**
 * Modules\Directory\Entities\Currency
 *
 * @property int $id
 * @property int|null $country_id Основные сведения о валюте.ID страны
 * @property string $name Основные сведения о валюте.Название валюты
 * @property string $emission_center Основные сведения о валюте.Эмиссионный центр
 * @property string|null $symbol Основные сведения о валюте.Знак
 * @property string|null $sample_url Основные сведения о валюте.Образец
 * @property string|null $iso_name ISO 4217.Название
 * @property string|null $iso_code ISO 4217.Код
 * @property string|null $iso_code_name ISO 4217.Название кода(аббревиатура)
 * @property string|null $currency_unit Разменная денежная единица.Название
 * @property string|null $currency_unit_sample_url Разменная денежная единица.Образец
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $descr
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereCurrencyUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereCurrencyUnitSampleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereEmissionCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereIsoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereIsoCodeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereIsoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereSampleUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    protected $fillable = [
        'id',
        'country_id',
        'name',
        'emission_center',
        'symbol',
        'sample_url',
        'iso_name',
        'iso_code',
        'iso_code_name',
        'currency_unit',
        'currency_unit_sample_url',
        'created_at',
        'updated_at',
        'descr',
    ];
    protected $table = 'spr_currencies';

    public static function getCurrencySite()
    {
        return CurrencyRepository::getDataSite();
    }

    public static function reloadCurrenciesSite()
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
