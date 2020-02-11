<?php

namespace Modules\Directory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Directory\Entities\Unit;
use Modules\Directory\Traits\TraitDevModel;

class ApiUnitController extends Controller
{

    use TraitDevModel;
    protected $model;


    public function index(Request $request)
    {
        return $this->getApiModel($request, Unit::class);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
           // 'name' => 'required|unique:spr_countries,name',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            $unit = new Unit;
            $unit->id = $request->id;
            $unit->code = $request->code;
            $unit->name = $request->name;
            $unit->symbol_national = $request->symbol_national;
            $unit->symbol_intern = $request->symbol_intern;
            $unit->code_national = $request->code_national;
            $unit->code_intern = $request->code_intern;
            $unit->section = $request->section;
            $unit->unit_group = $request->unit_group;
            $unit->descr = $request->descr;
            $unit->save();
        }
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
        $unit = Unit::find($id);
        $unit->id = $request->id;
        $unit->code = $request->code;
        $unit->name = $request->name;
        $unit->symbol_national = $request->symbol_national;
        $unit->symbol_intern = $request->symbol_intern;
        $unit->code_national = $request->code_national;
        $unit->code_intern = $request->code_intern;
        $unit->section = $request->section;
        $unit->unit_group = $request->unit_group;
        $unit->descr = $request->descr;
        $unit->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Unit::destroy([$id]);
    }
}
