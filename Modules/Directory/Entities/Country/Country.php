<?php

namespace Modules\Directory\Entities\Country;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\Directory\Entities\Country\Attribute;
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

    /**
     * Return Collection Country from site
     * @param string $name
     * @return Collection
     */
    public static function getDataSite()
    {
        return CountryRepository::getCountryData();
    }

    /**
     *Reload data Country from site
     *  @return bool
     */
    public static function reloadDataSite()
    {
        return CountryRepository::reloadCountryData();
    }

    /**
     * Return element from Country Collection
     * @param string $name
     * @return item Collection
     */
    public static function getByNameDataSite($name)
    {
        $countries = self::getDataSite();
        return $countries->whereIn('name', [$name]);
    }

}
