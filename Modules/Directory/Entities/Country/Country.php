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
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Directory\Entities\Country\Attribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read \Modules\Directory\Entities\Country\Details $details
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Country findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Country whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Country\Country whereUpdatedAt($value)
 */
class Country extends Model
{
    use Sluggable;
    protected $table = 'spr_countries';

    const captions = [
        'Наименование',
        'slug',
    ];

    protected $fillable = [
        'name',
        'slug'
    ];


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


    /**
     * Names columms for model
     * @return array
     */
    public static function getColumns()
    {
        return self::query()->getModel()->getFillable();
    }


    /**
     * Names columms with captions for model
     * @return array|string
     */
    public static function getColumnsWithCaptions()
    {
        $data = [];
        $columns = self::query()->getModel()->getFillable();
        foreach ($columns as $index => $column) {
            $ar['dataField'] = $column;
            $ar['caption'] = self::captions[$index];
            $data[$index] = $ar;
        }
        return json_encode($data);

    }


}
