<?php

namespace Modules\Skill\Entities;

use Modules\Skill\Repositories\LanguageRepository;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    const captions = ['ID','Наименование', 'slug', 'Описание'];

    protected $fillable = ['id','name', 'slug', 'descr'];
    protected $table='sk_languages';


public static function getLanguagesSite(){
      return LanguageRepository::getDataSite();
}


    public static function reloadLanguagesSite(){
        return LanguageRepository::reloadDataSite();
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
