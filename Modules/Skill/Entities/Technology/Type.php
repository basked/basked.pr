<?php

namespace Modules\Skill\Entities\Technology;

use Illuminate\Database\Eloquent\Model;
use Modules\Skill\Entities\Technology;

/**
 * Modules\Skill\Entities\Technology\Type
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $descr
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Skill\Entities\Technology[] $technologies
 * @property-read int|null $technologies_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology\Type whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Type extends Model
{
    const captions = ['ID', 'Наименование', 'slug', 'Описание'];
    protected $fillable = ['id','name','slug','descr'];
    protected $table = 'sk_types';

    public function technologies()
    {
        return $this->hasMany(Technology::class, 'type_id', 'id');
    }



    /**
     * Names columms for model
     * @return array
     */
    public static function getColumns()
    {
        return self::query()->getModel()->getFillable();
    }


    /**
     * Names columms with captions for model
     * @return array|string
     */
    public static function getColumnsWithCaptions()
    {
        $data = [];
        $columns = self::query()->getModel()->getFillable();
        foreach ($columns as $index => $column) {
            $ar['dataField'] = $column;
            $ar['caption'] = self::captions[$index];
            $data[$index] = $ar;
        }
        return json_encode($data);

    }

}
