<?php

namespace Modules\Skill\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Skill\Entities\Technology;
use Modules\Skill\Entities\Technology\Type;
use Modules\Skill\Traits\TraitSkillDevModel;

class TechnologyController extends Controller
{
    use TraitSkillDevModel;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $columns = Technology::getColumns();
        $captions = Technology::getColumnsWithCaptions();
        return view('skill::technologies.index', ['columns' => $columns, 'captions' => $captions]);
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


    /**
     *  Print tree structure in blade template
     * @return \View
     */
    public function printTreeTemplate()
    {
        $technologies = Technology::whereTypeId(7)->with('childrenTechnologies')->get();
        return view('skill::technologies.technologies', compact('technologies'));
    }


    /**
     * Print custom parent tree structure
     *
     */
    public function printTree(Request $request)
    {
        $sep = '-';
        $params = [
            ['column' => 'type_id', 'op' => '=', 'val' => 7],
            ['column' => 'name', 'op' => 'like', 'val' => "%Android%"],
        ];
        $technogies = $this->getApiModel($request, Technology::class, $params, true)['model'];
        $technologies = $technogies->with('childrenTechnologies')->get();
        foreach ($technologies as $technology) {
            echo '<b>' . $technology->name . '</b><br>';
            foreach ($technology->childrenTechnologies as $childTechnology) {
                $this->printTreeChild($childTechnology, $sep);
            }
        }
    }

    /**
     * Print custom child tree structure
     * @param Model $child_technology
     * @param string $sep
     *
     */
    public function printTreeChild($child_technology, $sep)
    {
        $sep = $sep . '----';
        echo $sep . $child_technology->name . '<br>';;
        if ($child_technology->technologies) {
            foreach ($child_technology->technologies as $childTechnology)
                $this->printTreeChild($childTechnology, $sep);
        }
    }

    public function treeData()
    {

      return json_decode(Technology::getTreeData())->data;
    }

}
