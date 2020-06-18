<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

class Dependency extends Model
{
    protected $table='sk_dependencies';
    protected $fillable = ['id', 'predecessorId', 'successorId', 'type'];
}
