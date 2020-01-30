<?php

namespace Modules\Directory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Directory\Repositories\ContinentRepository;
use Modules\Directory\Entities\Continent;

/*
 * Class ContinentController
 * @package Modules\Directory\Http\Controllers
 */
class ContinentController extends Controller
{
    /*
     *  @var Continentrepository
     * */
     private   $continentRepository;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct( )
    {
        $this->continentRepository=ContinentRepository::class;
    }

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
}
