<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;

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
