<?php

namespace Modules\Directory\Entities\Country;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Directory\Entities\Country\Attribute
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute query()
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    use Sluggable;
    protected $fillable = ['key', 'name','type','group'];
    protected $table = 'spr_countries_attr';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function countries()
    {
        return $this->belongsToMany(Country:: class, 'spr_countries_attr_val', 'country_attr_id', 'country_id')->withPivot('val');
    }
}
