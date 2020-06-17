<?php

namespace Modules\Skill\Http\Controllers\Api;;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Developer;
use Modules\Skill\Entities\Roadmap;
use Modules\Skill\Entities\Technology;
use Modules\Skill\Entities\Technology\Type;
use Modules\Skill\Traits\TraitSkillDevModel;
use Illuminate\Support\Str;
use Validator;

class ApiRoadmapController extends Controller
{

    use TraitSkillDevModel;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->getApiModel($request, Roadmap::class, []);
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
     * @return Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            // 'name' => 'required|unique:spr_countries,name',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            $roadmap = new Roadmap();
            $roadmap->id = $request->id;
            $roadmap->developer_id = $request->developer_id;
            $roadmap->name = $request->name;
            $roadmap->slug = Str::slug($request->name, '-');
            $roadmap->descr = $request->descr;
            $roadmap->save();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('skill::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('skill::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $roadmap = Roadmap::find($id);
        $roadmap->update();
        $roadmap->id = is_null($request->id) ? $roadmap->id : $request->id;
        $roadmap->name = is_null($request->name) ? $roadmap->name : $request->name;
        $roadmap->slug = Str::slug(is_null($request->name) ? $roadmap->name : $request->name, '-');
        $roadmap->developer_id = is_null($request->developer_id) ? $roadmap->developer_id : $request->developer_id;
        $roadmap->descr = is_null($request->descr) ? $roadmap->descr : $request->descr;
        $roadmap->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Roadmap::destroy([$id]);
    }

    /** Все разработчики для Roadmap
     *
     *
     * */
    public function lookDevelopers()
    {
        $data['data'] = Developer::all('id', 'name')->toArray();
        return $data;
    }


    /** Все технологии типа Roadmap
     *
     *
     * */
    public function lookTechnologies()
    {
        $type_id = Type::where('name', 'like', '%Roadmap%')->value('id');
        $data['data'] = Technology::whereTypeId($type_id)->get(['id', 'name'])->toArray();
        return $data;
    }

    /** Сбрасываем значение для разработчика
     *
     *
     * */
    public function resetDeveloper(Request $request, $id)
    {
        //  dd($request->all());
        $roadmap = Roadmap::find($id);
        $roadmap->update();
        $roadmap->id = is_null($request->id) ? $roadmap->id : $request->id;
        $roadmap->name = is_null($request->name) ? $roadmap->name : $request->name;
        $roadmap->slug = Str::slug(is_null($request->slug) ? $roadmap->slug : $request->slug, '-');
        $roadmap->developer_id = null;
        $roadmap->descr = is_null($request->descr) ? $roadmap->descr : $request->descr;
        $roadmap->save();
    }


    public function technologies($id)
    {
        $data['data'] = Roadmap::find($id)->technologies()->get()->toArray();
        return $data;
    }


    /** Сохраняем  в технологию для дорожной карты
     *
     * ***/
    public function insertTechnology(Request $request, $id)
    {
        Roadmap::find($id)->technologies()->attach($request->id);
    }


    /** Обновляем технологию для дорожной карты
     *
     * ***/
    public function updateTechnology(Request $request, $id, $technology_id)
    {
        $technology = Roadmap::find($id)->technologies()->find($technology_id);
        $technology->pivot->technology_id = is_null($request->id) ? $technology->technology_id : $request->id;
        $technology->pivot->save();
    }

    /** Удаляем  в технологию для дорожной карты
     *
     * ***/
    public function deleteTechnology($id, $technology_id)
    {
        Roadmap::find($id)->technologies()->detach($technology_id);
    }


}
