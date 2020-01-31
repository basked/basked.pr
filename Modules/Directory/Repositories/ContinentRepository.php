<?php

namespace Modules\Directory\Repositories;
use Modules\Directory\Entities\Continent;
use Modules\Directory\Repositories\Interfaces\ContinentRepositoryInterface;

class ContinentRepository implements ContinentRepositoryInterface
{

    public function all()
    {
        return Continent::all();
    }

    public function getContintnent($id)
    {
        return Continent::find($id);
    }
}
