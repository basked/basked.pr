<?php

namespace Modules\TreeLife\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\TreeLife\Entities\tl_relationship
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\TreeLife\Entities\tl_relationship newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\TreeLife\Entities\tl_relationship newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\TreeLife\Entities\tl_relationship query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\TreeLife\Entities\tl_relationship whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\TreeLife\Entities\tl_relationship whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\TreeLife\Entities\tl_relationship whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\TreeLife\Entities\tl_relationship whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\TreeLife\Entities\tl_relationship whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class tl_relationship extends Model
{
    protected $fillable = [];

}
