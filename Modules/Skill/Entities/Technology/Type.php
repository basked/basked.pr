<?php

namespace Modules\Skill\Entities\Technology;

use Illuminate\Database\Eloquent\Model;
use Modules\Skill\Entities\Technology;

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
