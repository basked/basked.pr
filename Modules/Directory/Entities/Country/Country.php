<?php

namespace Modules\Directory\Entities\Country;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\Directory\Entities\Country\Attribute;
use Modules\Directory\Entities\Country\Details;
use Modules\Directory\Repositories\CountryRepository;
use Modules\Directory\Repositories\Interfaces\CountryRepositoryInterface;


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
    protected $table = 'spr_countries';
    protected $fillable = ['name'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    /**
     *  Relationship on spr_countries_details
     *
     **/
    public function details(){
        return $this->hasOne(Details::class,'country_id','id');
    }

    /**
     *  Relationship on spr_countries_attr
     *
    **/
    public function attributes()
    {
        return $this->belongsToMany(Attribute:: class, 'spr_countries_attr_val', 'country_id', 'country_attr_id')->withPivot('val');
    }

    /**
     * Return Collection Country from site
     * @param string $name
     * @return Collection
     */
    public static function getCountriesSite()
    {
        return CountryRepository::getDataSite();
    }

    /**
     *Reload data Country from site
     *  @return bool
     */
    public static function reloadCountriesSite()
    {
        return CountryRepository::reloadDataSite();
    }

    /**
     * Return element from Country Collection
     * @param string $name
     * @return item Collection
     */
    public static function getCountryByNameSite($name)
    {
        $countries = self::getCountries();
        return $countries->whereIn('name', [$name]);
    }

    //
    public static function  getCountryAttributesSite(Country $country){
        return CountryRepository::getAttributesDataSite($country);
    }

}
