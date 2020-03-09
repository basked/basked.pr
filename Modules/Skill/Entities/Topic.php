<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Skill\Entities\Topic
 *
 * @property int $id
 * @property int $technology_id Ссылка на технологию
 * @property string $name Наименование темы
 * @property string $slug Slug
 * @property string|null $descr Описание
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Skill\Entities\Technology $technology
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic whereTechnologyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Topic whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Skill\Entities\Example[] $examples
 * @property-read int|null $examples_count
 */
class Topic extends Model
{
    const captions = ['ID', 'Технология', 'Наименование', 'slug', 'Описание'];
    protected $fillable = ['id', 'technology_id', 'name', 'slug', 'descr'];
    protected $table='sk_topics';

    /**
     *  Refer on Technology Model
     *
     * **/
    public function technology(){
       return $this->belongsTo(Technology::class,'technology_id','id');
    }
    /**
     *  Refer on Topic Model
     *
     * **/
    public function examples(){
        return $this->hasMany(Example::class,'topic_id','id');
    }

    /**
     *  Refer on Topic Model
     *
     * **/
    public function links(){
        return $this->hasMany(Link::class,'topic_id','id');
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
