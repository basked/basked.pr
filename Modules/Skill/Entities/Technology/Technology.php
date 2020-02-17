<?php

namespace Modules\Skill\Entities;

use Modules\Skill\Entities\Technology\Type;
use Modules\Skill\Repositories\TechnologyRepository;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    const captions = ['ID', 'Наименование', 'slug', 'Описание','Тип', 'Главная категория'];

    protected $fillable = ['id', 'name', 'slug', 'descr','type_id', 'technology_id' ];
    protected $table = 'sk_technologies';

    /**
     * Тип технологии
     * @return type
     **/
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id' );
    }

    // Each category may have one parent
    public function parent() {
        return $this->belongsToOne(static::class, 'technology_id');
    }

    // Each category may have multiple children
    public function children() {
        return $this->hasMany(static::class, 'technology_id');
    }


    public static function getTechnologiesSite()
    {
        return TechnologyRepository::getDataSite();
    }


    public static function reloadTechnologiesSite()
    {
        return TechnologyRepository::reloadDataSite();
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
