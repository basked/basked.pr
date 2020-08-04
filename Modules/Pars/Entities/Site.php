<?php

namespace Modules\Pars\Entities;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['*'];
    protected $table='pars_table';

}
