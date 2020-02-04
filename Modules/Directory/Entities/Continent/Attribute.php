<?php

namespace Modules\Directory\Entities\Continent;

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
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Directory\Entities\Continent[] $continents
 * @property-read int|null $continents_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\ContinentAttr whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\ContinentAttr whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\ContinentAttr whereUpdatedAt($value)
 * @property string $group
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Continent\Attribute whereGroup($value)
 */
class Attribute extends Model
{
    use Sluggable;
    protected $table='spr_continents_attr';
    protected $fillable=[] ;

    // можем ли выненести в репозиторий
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function continents(){
        return $this->belongsToMany(Continent::class, 'spr_continents_attr_val', 'continent_attr_id' ,'continent_id')->withPivot('val');
    }

}
