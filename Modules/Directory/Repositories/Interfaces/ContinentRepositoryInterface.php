<?php


namespace Modules\Directory\Repositories\Interfaces;


interface ContinentRepositoryInterface
{
    public function all();
    public function getContintnent($id);
    /*
     * Данные из интернета по континентам
     *
     * */
    public function getContinentData();


}
