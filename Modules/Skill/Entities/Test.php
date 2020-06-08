<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table='sk_test';
    protected $fillable = ['id','name','descr'];

}
