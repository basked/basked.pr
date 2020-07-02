<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Skill\Entities\Task
 *
 * @property int $id
 * @property int $parentId
 * @property string $title
 * @property string $start
 * @property string $end
 * @property int $progress
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Task whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    protected $table = 'sk_tasks';
    protected $fillable = ['id', 'parentId', 'title', 'start', 'end', 'progress'];

}
