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
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property string $group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $key
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Directory\Entities\Country\Country[] $countries
 * @property-read int|null $countries_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Attribute whereUpdatedAt($value)
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
