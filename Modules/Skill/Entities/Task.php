<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'sk_tasks';
    protected $fillable = ['id', 'parentId', 'title', 'start', 'end', 'progress'];

}
