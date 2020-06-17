<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Skill\Entities\Technology\Type;
use Modules\Skill\Traits\TraitSkillDevModel;

class ApiTypeController extends Controller
{

    use TraitSkillDevModel;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->getApiModel($request, Type::class, []);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('skill::create');
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
            $technology = new Type();
            $technology->id = $request->id;
            $technology->name = $request->name;
            $technology->slug = Str::slug($request->name, '-');
            $technology->descr = $request->descr;
            $technology->save();
        }
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);
        $type->update();
        $type->id = is_null($request->id) ? $type->id : $request->id;
        $type->name = is_null($request->name) ? $type->name : $request->id;
        $type->slug = Str::slug(is_null($request->name) ? $type->name : $request->id, '-');
        $type->descr = is_null($request->descr) ? $type->descr : $request->descr;
        $type->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Type::destroy([$id]);
    }


    public function lookTypes( $params='')
    {
        if ($params=="") {
            $data['data'] = Type::all('id', 'name')->toArray();
        } else {
            $data['data'] = Type::where('name', 'like', '%' . $params . '%')->get(['id', 'name'])->toArray();
        }
        return $data;
    }
}
