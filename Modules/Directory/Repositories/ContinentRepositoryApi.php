<?php

namespace Modules\Directory\Repositories;
use Modules\Directory\Entities\Continent;
use Modules\Directory\Repositories\Interfaces\ContinentRepositoryInterface;


class ContinentRepositoryApi implements ContinentRepositoryInterface
{

    public function all()
    {
       // json_encode(Continent::all()->toJson(),ensure_ascii=False);
      return Continent::all()->toArray();
    }

    public function getContintnent($id)
    {
        return json_decode( Continent::find($id)->toJson(),JSON_UNESCAPED_UNICODE);
    }
}
