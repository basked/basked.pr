<?php

namespace Modules\Directory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Directory\Entities\Country\Attribute;
use Modules\Directory\Entities\Country\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Model::unguard();

// TODO: Парсинг атрибутов по id модели страны
        try {
            Country::reloadCountriesSite();
            $countries = Country::all();
            foreach ($countries as $country) {
                $atrrtibutes = Country::getCountryAttributesSite($country);
                foreach ($atrrtibutes as $atrrtibute) {
                    if (!empty($atrrtibute)) {
                        if (Attribute::where('key', $atrrtibute['content_key'])->count() == 0) {
                            $attr = new Attribute([
                                'key' => $atrrtibute['content_key'],//?'':Sluggable::get('name'),
                                'name' => $atrrtibute['label'],
                                'type' => 'string',
                                'group' => 'basic_info'
                            ]);
                            $attr->save();
                        } else {
                            $attr = Attribute::where('key', $atrrtibute['content_key'])->first();
                        }
                        $country->attributes()->attach($attr->id, ['val' => $atrrtibute['content_val']]);
                    }
                }
            }
        } catch (\Exception $e){
            echo 'Ошибка при парсинге справочника стран'. $e->getMessage();
        }

    }
}
