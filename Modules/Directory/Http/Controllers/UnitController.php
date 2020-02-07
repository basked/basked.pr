<?php

namespace Modules\Directory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Directory\Entities\Unit;
use Symfony\Component\Console\Helper\Helper;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

       $fields = ['id', 'code', 'name', 'slug', 'symbol_national', 'symbol_intern', 'code_national', 'code_intern', 'section', 'unit_group', 'descr'];


        return view('directory::units.index',['fields'=>$fields ]);
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


    /**
     * Test function
     *
     */
    public function test()
    {
      Unit::reloadUnitsSite();
    }
}
