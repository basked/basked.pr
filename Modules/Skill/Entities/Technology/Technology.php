<?php

namespace Modules\Skill\Entities;

use Modules\Skill\Entities\Technology\Type;
use Modules\Skill\Repositories\TechnologyRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Skill\Entities\Technology
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $descr
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $type_id
 * @property int|null $technology_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Skill\Entities\Technology[] $childrenTechnologies
 * @property-read int|null $children_technologies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Skill\Entities\Technology[] $technologies
 * @property-read int|null $technologies_count
 * @property-read \Modules\Skill\Entities\Technology\Type|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology whereTechnologyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Technology whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
    public function technologies() {
//        return $this->belongsToOne(static::class, 'technology_id');
        return $this->hasMany(static::class, 'technology_id');
    }

    // Each category may have multiple children
    public function childrenTechnologies() {
//       return $this->hasMany(static::class, 'technology_id');
       return $this->hasMany(static::class, 'technology_id')->with('technologies');
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

    public static function getTreeData(){
        return TechnologyRepository::treeData();
    }

}
