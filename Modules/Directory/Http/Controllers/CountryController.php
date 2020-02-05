<?php

namespace Modules\Directory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Directory\Entities\Country\Country;
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
        return view('directory::index');
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
       if( Country::reloadDataSite()){
           echo 'reload';
       } else {
           echo 'NO reload';
       };

        /*     dd( Country::getDataSite()->where('name','Россия')->sortBy('name')->all());
            dd( Country::getDataSite());
            dd( Country::getByNameDataSite('Беларусь')->toArray());*/
    }


}
