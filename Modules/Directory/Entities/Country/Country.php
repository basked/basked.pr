<?php

namespace Modules\Directory\Entities\Country;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Modules\Directory\Entities\Country\Attribute;


/**
 * Modules\Directory\Entities\Country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country query()
 * @mixin \Eloquent
 */
class Country extends Model
{
    use Sluggable;
    protected $table = 'spr_continents';

    protected $fillable = [];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute:: class, 'spr_continents_attr_val', 'continent_id', 'continent_attr_id')->withPivot('val');
    }
}
