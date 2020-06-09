<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Skill\Entities\Link
 *
 * @property int $id
 * @property int $topic_id Тема
 * @property string|null $name Наименование
 * @property string|null $url Код программы
 * @property string|null $slug slug
 * @property string|null $descr Описание
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Skill\Entities\Topic $topic
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Link whereUrl($value)
 * @mixin \Eloquent
 */
class Link extends Model
{
    const captions = ['ID', 'Тема', 'Наименование','Ссылка', 'slug', 'Описание'];
    protected $fillable = ['id', 'topic_id', 'name', 'url', 'slug', 'descr'];
    protected $table='sk_links';

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
