<?php

namespace Modules\Directory\Entities\Country;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Directory\Entities\Country\Details
 *
 * @property int $id
 * @property int $country_id
 * @property string|null $name
 * @property string|null $descr
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $url
 * @property-read \Modules\Directory\Entities\Country\Country $country
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Details whereUrl($value)
 * @mixin \Eloquent
 */
class Details extends Model
{
    protected $fillable = ['name','descr','url' ];
    protected $table='spr_countries_details';

    public function country(){
        return $this->belongsTo(Country::class, 'country_id','id');
    }
}
