<?php

namespace Modules\Directory\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
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
 * @property string $url
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent whereUrl($value)
 */
class Continent extends Model
{
    use Sluggable;
    protected $table='spr_continents';
    protected $fillable = [];


     // можем ли выненести в репозиторий
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function attributes(){

            return $this->belongsToMany('spr_continents_attr', 'spr_continents_attr', 'continent_id', 'continent_attr_id');
    }

}
