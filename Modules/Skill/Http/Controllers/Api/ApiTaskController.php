<?php

namespace Modules\Skill\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Skill\Entities\Task;

class ApiTaskController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getId()
    {
        return Task::all()->max('id');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $task = Task::all(['id', 'parentId', 'title', 'start', 'end', 'progress']);
        return $task;
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
            $task = new Task();
            $task->parentId = $request->parentId;
            $task->title = $request->title;
            $task->start = date('Y-m-d H:i:s', strtotime($request->start));
            $task->end = date('Y-m-d H:i:s', strtotime($request->end));
            $task->progress = $request->progress;
            $task->save();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
     return   Task::destroy($id);
    }
}
