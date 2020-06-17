<?php

namespace Modules\Skill\Http\Controllers\Api;;
//загружаем скрипт для работы с php

//

use DataController;
use DevExtreme\DbSet;
use DevExtreme\DataSourceLoader;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Skill\Entities\Roadmap;
use Modules\Skill\Entities\Technology;
use Modules\Skill\Entities\Technology\Type;
use Modules\Skill\Entities\Test;
use Modules\Skill\Traits\TraitSkillDevModel;
use mysqli;
use function MongoDB\BSON\toJSON;


class ApiTestController extends Controller
{
    use TraitSkillDevModel;
    private $dbSet;
    protected $model;
    protected $fields;
    protected $request;
    protected $take_default = 5;
    private $controller;
    private $params;

    public function __construct()
    {
        $this->controller = new DataController("127.0.0.1", "basked", "basked", "basked_db", Test::getModel()->getTable());
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $params = $this->GetParseParams($request->toArray());
        return $this->controller->Get($params);
    }


    public function listLinks(Request $request)
    {
//        $test_data=Test::all()->toJson();
//        return $test_data;
        return $this->getApiModel($request, Test::class, []);
//        return Test::all()->toJson();
    }

    // Поиск для Lookup
    public function searchLookup($key)
    {
        return Test::where('descr', 'like', '%' . $key . '%')->get(['id', 'descr'])->toJson();
    }


    /*тестирование Devexreme for PHP*/


    function GetParseParams($params, $assoc = false)
    {
        $result = NULL;
        if (is_array($params)) {
            $result = array();
            foreach ($params as $key => $value) {
                $result[$key] = json_decode($params[$key], $assoc);
                if ($result[$key] === NULL) {
                    $result[$key] = $params[$key];
                }
            }
        } else {
            $result = $params;
        }
        return $result;
    }

    function GetParamsFromInput()
    {
        $result = NULL;
        $content = file_get_contents("php://input");
        if ($content !== false) {
            $params = array();
            parse_str($content, $params);
            $result = $this->GetParseParams($params, true);
        }
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
             'name' => 'required|unique:spr_countries,name',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        } else {
            $test = new Test();
            $test->id = $request->id;
            $test->name = $request->name;
            $test->descr = $request->descr;
            $test->id_bas = $request->id_bas;
            $test->save();
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
        $test = Test::findOrFail($id);
        $test->update();
        $test->id = is_null($request->id) ? $test->id : $request->id;
        $test->name = is_null($request->name) ? $test->name : $request->name;
        $test->descr = is_null($request->descr) ? $test->descr : $request->descr;
        $test->id_bas = is_null($request->id_bas) ? $test->id_bas : $request->id_bas;

        $test->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Test::destroy([$id]);
    }
}
