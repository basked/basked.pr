<?php

namespace Modules\Directory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Directory\Entities\Country\Country;
use Modules\Directory\Traits\DevModelTrait;
use Modules\Directory\Traits\TraitDevModel;
use Illuminate\Support\Facades\Validator;


class ApiCountryController extends Controller
{
    use TraitDevModel;
    protected $model;


    public function index(Request $request)
    {
        return $this->getApiModel($request, Country::class);
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
        }
        $country = new Country;
        $country->id = $request->id;
        $country->name = $request->name;
        $country->slug = $request->slug;
        $country->save();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $country->update();
        $country->id = $request->id;
        $country->name = $request->name;
        $country->slug = Str::slug($request->name, '-');
        $country->save();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Country::destroy([$id]);
    }

    public function attributes($id)
    {
        $res = [];
        $res['data'] = Country::find($id)->attributes;
        $res['totalCount'] = Country::find($id)->attributes->count();
         return json_encode($res);
    }
}
