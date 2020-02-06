<?php

namespace Modules\Directory\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Modules\Directory\Repositories\UnitRepository;

class Unit extends Model
{
    use Sluggable;
    protected $fillable = ['code',
        'name',
        'code',
        'slug',
        'symbol_national',
        'symbol_intern',
        'code_national',
        'code_intern',
        'section',
        'unit_group',
        'descr'];
    protected $table = 'spr_units';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public static function getUnitsSite()
    {
        return UnitRepository::getDataSite();
    }



    public static function reloadUnitsSite()
    {
        return UnitRepository::reloadDataSite();
    }


}
