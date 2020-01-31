<?php

namespace Modules\Directory\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Directory\Entities\Continent
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $descr
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent whereSlug($value)
 * @mixin \Eloquent
 */
class Continent extends Model
{   protected $table='spr_continents';
    protected $fillable = [];
}
