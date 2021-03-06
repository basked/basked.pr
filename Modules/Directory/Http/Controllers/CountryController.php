<?php

namespace Modules\Directory\Http\Controllers;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Directory\Entities\Country\Attribute;
use Modules\Directory\Entities\Country\Country;
use Modules\Directory\Entities\Country\Details;
use Modules\Directory\Repositories\Interfaces\CountryRepositoryInterface;

class CountryController extends Controller
{

    private $countryRepository;

    function __construct(CountryRepositoryInterface $countryRepository)
    {
        // внедряем continentRepository
        $this->countryRepository = $countryRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $columns = Country::getColumns();
        $captions = Country::getColumnsWithCaptions();
        return view('directory::countries.index', ['columns' => $columns,'captions'=>$captions]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('directory::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('directory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('directory::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function test()
    {
//        $country= Country::find(1);
//        dd( $country::getCountryDetailsSite($country));
        // TODO: Уникальные значения атрибута РЕГИОН
//        $col = new Collection;
//        $countries = Attribute::find(5)->countries;
//        foreach ($countries as $country) {
//            $col->push($country->pivot->val.'=>'.$country->name);
//
//            // echo  $country->pivot->val.'<br>';
//        }
//        dd($col->unique()->sort()->all());


// TODO: Парсинг атрибутов по id модели страны
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


//        foreach ($countries as $country){
//            echo '<h1>'.$country->name.'</h1>';
//            echo '<pre>';
//            print_r(Country::getAttributesDataSite($country));
//            echo '</pre>';
//        }

        // TODO: Перегрузка дпнных по странам
//          if( Country::reloadCountriesSite()){
//              echo 'reload';
//          } else {
//              echo 'NO reload';
//          };

// TODO: Поиск страны по наисменованию
//        dd(Country::getCountryByNameSite('Беларусь')->toArray());
    }
}
