<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Skill\Entities\Test
 *
 * @property int $id
 * @property string $name
 * @property string $descr
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $id_bas
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test whereIdBas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Test whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Test extends Model
{
    protected $table='sk_test';
    protected $fillable = ['id','name','descr','id_bas'];

}
