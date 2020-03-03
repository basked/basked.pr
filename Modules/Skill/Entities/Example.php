<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Skill\Entities\Topic;

/**
 * Modules\Skill\Entities\Example
 *
 * @property int $id
 * @property int $topic_id Тема
 * @property string|null $name Наименование
 * @property string|null $code Код программы
 * @property string|null $slug slug
 * @property string|null $descr Описание
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Skill\Entities\Topic $topic
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Example whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Example extends Model
{
    const captions = ['ID', 'Тема', 'Наименование','Пример кода', 'slug', 'Описание'];
    protected $fillable = ['id', 'topic_id', 'name', 'code', 'slug', 'descr'];
    protected $table='sk_examples';

    /**
     *  Refer on Technology Model
     *
     * **/
    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
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
