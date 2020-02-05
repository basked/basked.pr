<?php

namespace Modules\Directory\Entities\Country;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $fillable = [ ];
    protected $table='spr_countries_details';

    public function country(){
        return $this->belongsTo(Country::class, 'country_id','id');
    }
}
