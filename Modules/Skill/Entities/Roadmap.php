<?php

namespace Modules\Skill\Entities;

use Illuminate\Database\Eloquent\Model;


/**
 * Modules\Skill\Entities\Roadmap
 *
 * @property int $id
 * @property int $developer_id
 * @property string $name
 * @property string $slug
 * @property string|null $descr
 * @property-read \Modules\Skill\Entities\Developer $developer
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Roadmap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Roadmap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Roadmap query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Roadmap whereDescr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Roadmap whereDeveloperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Roadmap whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Roadmap whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Skill\Entities\Roadmap whereSlug($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Skill\Entities\Technology[] $technologies
 * @property-read int|null $technologies_count
 */
class Roadmap extends Model
{
    protected $table = 'sk_roadmaps';
    const captions = ['ID', 'Разработчик', 'Наименование', 'slug', 'Описание'];
    protected $fillable = ['id', 'developer_id', 'name', 'slug', 'descr'];
    public $timestamps = false;

    /** Related on Developer
     *
     *
     *
     * **/
    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id', 'id');
    }


    /**
     *  Relationship on sk_technology_roadmap
     *
     **/
    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'sk_technology_roadmap','roadmap_id', 'technology_id');
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
