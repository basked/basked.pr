<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Skill\Entities\Resource
 *
 * @property int $id
 * @property string $text
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Resource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Resource query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Resource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Resource whereText($value)
 * @mixin \Eloquent
 */
class Resource extends Model
{
    protected $fillable = ['id', 'text'];
    protected $table='sk_resources';
}
