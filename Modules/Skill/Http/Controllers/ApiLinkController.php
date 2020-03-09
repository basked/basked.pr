<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Link;
use Modules\Skill\Entities\Topic;
use Illuminate\Support\Str;

class ApiLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('skill::index');
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
    public function links($id)
    {
        $data['data'] = Topic::find($id)->links()->get()->toArray();
        return $data;
    }


    /** Сохраняем  в технологию для дорожной карты
     *
     * ***/
    public function insertLink(Request $request, $topic_id)
    {
        $link = new Link();
        $link->id = $request->id;
        $link->name = $request->name;
        $link->slug = Str::slug($request->name);
        $link->topic_id = $topic_id;
        $link->url = $request->code;
        $link->descr = $request->descr;
        $link->save();
    }


    /** Обновляем технологию для дорожной карты
     *
     * ***/
    public function updateLink(Request $request, $topic_id, $link_id)
    {
        $link = Link::find($link_id);
        $link->update();
        $link->id = is_null($request->id) ? $link->id : $request->id;
        $link->name = is_null($request->name) ? $link->name : $request->name;
        $link->slug = Str::slug(is_null($request->name) ? $link->name : $request->name);
        $link->topic_id = is_null($topic_id) ? $link->topic_id : $topic_id;
        $link->url = is_null($request->code) ? $link->url : $request->url;
        $link->descr = is_null($request->descr) ? $link->descr : $request->descr;
        $link->save();
    }

    /** Удаляем  в технологию для дорожной карты
     *
     * ***/
    public function deleteLink($topic_id, $link_id)
    {
        Link::destroy([$link_id]);
    }

}
