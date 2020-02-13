<?php

namespace Modules\Skill\Entities\Technology;

use Illuminate\Database\Eloquent\Model;
use Modules\Skill\Entities\Technology;

class Type extends Model
{
    protected $fillable = ['id','name','slug','descr'];
    protected $table = 'sk_types';

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'sk_technology_type', 'type_id', 'technology_id');
    }
}
