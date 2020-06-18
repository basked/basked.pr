<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['id', 'text'];
    protected $table='sk_resources';
}
