<?php

namespace Modules\Directory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Directory\Entities\Continent;
use Modules\Directory\Entities\ContinentAttr;
use Modules\Directory\Repositories\ContinentRepository;
use Modules\Directory\Repositories\Interfaces\ContinentRepositoryInterface;


/*
 * Class ContinentController
 * @package Modules\Directory\Http\Controllers
 */

class ContinentController extends Controller
{

    private $continentRepository;

    function __construct(ContinentRepositoryInterface $continentRepository)
    {
        // внедряем continentRepository
        $this->continentRepository = $continentRepository;
    }


    public function set_len_print($s, $max_simbol){
        while(strlen($s)<$max_simbol){
            $s =$s."     ";
        }
        echo $s;
    }
    public function index()
    {   str_repeat('&nbsp;', 5);
        $continents = Continent::all();
        foreach ($continents as $continent){
            echo $continent->name.'|';

        }
        echo '<hr>';

        $continent_attributes = ContinentAttr::all();
        foreach ($continent_attributes as $continent_attribut){
            echo  $this->set_len_print($continent_attribut->name,20);

                foreach ( $continent_attribut->continents as $continent){
                    echo $continent->pivot->val.'|';
                }
                echo '<br>';
            }


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
}
