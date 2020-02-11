<?php

namespace Modules\Directory\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Modules\Directory\Repositories\UnitRepository;


/**
 * Modules\Directory\Entities\Unit
 *
 * @property int $id
 * @property int $code
 * @property string $name
 * @property string $slug
 * @property string|null $symbol_national
 * @property string|null $symbol_intern
 * @property string|null $code_national
 * @property string|null $code_intern
 * @property string $section
 * @property string $unit_group
 * @property string|null $descr
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereCodeIntern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereCodeNational($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereSymbolIntern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereSymbolNational($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereUnitGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Unit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Unit extends Model
{
    use Sluggable;

    const captions = [
        'ID',
        'Код',
        'Наименование',
        'Национальное симаольное обозначение',
        'Междунородное симаольное обозначение',
        'Национальное кодовое обозначение',
        'Междунородное кодовое обозначение',
        'Раздел',
        'Группа',
    ];

    protected $fillable = [
        'id',
        'code',
        'name',
        'symbol_national',
        'symbol_intern',
        'code_national',
        'code_intern',
        'section',
        'unit_group',
    ];

    protected $table = 'spr_units';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public static function getUnitsSite()
    {
        return UnitRepository::getDataSite();
    }

    public static function reloadUnitsSite()
    {
        return UnitRepository::reloadDataSite();
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
