<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Skill\Entities\ResourceAssignments
 *
 * @property int $id
 * @property int $taskId
 * @property int $resourceId
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\ResourceAssignments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\ResourceAssignments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\ResourceAssignments query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\ResourceAssignments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\ResourceAssignments whereResourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\ResourceAssignments whereTaskId($value)
 * @mixin \Eloquent
 */
class ResourceAssignments extends Model
{
    protected $table='sk_resource_assignments';
    protected $fillable = ['id', 'taskId', 'resourceId'];
}
