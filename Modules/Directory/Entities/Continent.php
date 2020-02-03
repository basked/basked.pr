<?php

namespace Modules\Directory\Entities;

//use Cviebrock\EloquentSluggable\Sluggable;
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Directory\Entities\ContinentAttr[] $c_attributes
 * @property-read int|null $c_attributes_count
 */
class Continent extends Model
{
//    use Sluggable;
 protected $fillable = [];
    protected $table='spr_continents';

   //protected $with='attribs';


     // можем ли выненести в репозиторий
//    public function sluggable()
//    {
//        return [
//            'slug' => [
//                'source' => 'name'
//            ]
//        ];
//    }
    public function continent_attributes(){
        return $this->belongsToMany('Modules\Directory\Entities\ContinentAttr', 'spr_continents_attr_val','continent_id','continent_attr_id')->withPivot('val');
        //           return $this->belongsToMany('spr_books', 'spr_autor_book','autor_id','book_id');
    }

}
