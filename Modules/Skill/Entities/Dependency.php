<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Skill\Entities\Dependency
 *
 * @property int $id
 * @property int $predecessorId
 * @property int $successorId
 * @property int $type
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Dependency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Dependency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Dependency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Dependency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Dependency wherePredecessorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Dependency whereSuccessorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Dependency whereType($value)
 * @mixin \Eloquent
 */
class Dependency extends Model
{
    protected $table='sk_dependencies';
    protected $fillable = ['id', 'predecessorId', 'successorId', 'type'];
}
