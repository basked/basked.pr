<?php

namespace Modules\Directory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Directory\Entities\Unit;
use Symfony\Component\Console\Helper\Helper;
use Illuminate\Database\Eloquent\Builder;
use  Illuminate\Database\Eloquent\Collection;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $columns = Unit::getColumns();
        $captions = Unit::getColumnsWithCaptions();
        return view('directory::units.index', ['columns' => $columns,'captions'=>$captions]);
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
//         [
//        {dataField: "id", caption: "ID"},
//        {dataField: "code", caption: "Код"},
//        {dataField: "name", caption: "Наименование"},
//        {dataField: "slug", caption: "SLUG"},
//        {dataField: "symbol_national", caption: "Национальное симаольное обозначение"},
//        {dataField: "symbol_intern", caption: "Междунородное симаольное обозначение"},
//        {dataField: "code_national", caption: "Национальное кодовое обозначение"},
//        {dataField: "code_intern", caption: "Междунородное кодовое обозначение"},
//        {dataField: "section", caption: "Раздел"},
//        {dataField: "unit_group", caption: "Группа"},
//        ]
       dd(Unit::getColumnsWithCaptions());


//
//        $collection = collect([
//            ['dataField' => 'Desk', 'caption' => 'Раздел'],
//            ['dataField' => 'Desk', 'caption' => 'Раздел'],
//
//        ]);
//
//       dd( $sorted = $collection->toJson() );

       // перегрузка единиц учета
       // Unit::reloadUnitsSite();
    }
}
