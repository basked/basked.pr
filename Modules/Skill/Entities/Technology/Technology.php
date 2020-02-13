<?php

namespace Modules\Skill\Entities;

use Modules\Skill\Entities\Technology\Type;
use Modules\Skill\Repositories\TechnologyRepository;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    const captions = ['ID', 'Наименование', 'slug', 'Описание'];

    protected $fillable = ['id', 'name', 'slug', 'descr'];
    protected $table = 'sk_technologies';

    public function types()
    {
        return $this->belongsToMany(Type::class, 'sk_technology_type', 'technology_id', 'type_id');
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
