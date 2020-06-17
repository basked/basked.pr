<?php

namespace Modules\Skill\Http\Controllers\Api;;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Example;
use Modules\Skill\Entities\Topic;
use Modules\Skill\Traits\TraitSkillDevModel;
use Illuminate\Support\Str;

class ApiExampleController extends Controller
{
    use TraitSkillDevModel;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

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
        //
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

/// для detail таблицы
///
    public function examples($id)
    {
        $data['data'] = Topic::find($id)->examples()->get()->toArray();
        return $data;
    }


    /** Сохраняем  в технологию для дорожной карты
     *
     * ***/
    public function insertExample(Request $request, $topic_id)
    {
        $example = new Example();
        $example->id = $request->id;
        $example->name = $request->name;
        $example->slug = Str::slug($request->name);
        $example->topic_id = $topic_id;
        $example->code = $request->code;
        $example->descr = $request->descr;
        $example->save();
    }


    /** Обновляем технологию для дорожной карты
     *
     * ***/
    public function updateExample(Request $request, $topic_id, $example_id)
    {
        $example = Example::find($example_id);
        $example->update();
        $example->id = is_null($request->id) ? $example->id : $request->id;
        $example->name = is_null($request->name) ? $example->name : $request->name;
        $example->slug = Str::slug(is_null($request->name) ? $example->name : $request->name);
        $example->topic_id = is_null($topic_id) ? $example->topic_id : $topic_id;
        $example->code = is_null($request->code) ? $example->code : $request->code;
        $example->descr = is_null($request->descr) ? $example->descr : $request->descr;
        $example->save();
    }

    /** Удаляем  в технологию для дорожной карты
     *
     * ***/
    public function deleteExample($topic_id, $example_id)
    {
        Example::destroy([$example_id]);
    }


}
