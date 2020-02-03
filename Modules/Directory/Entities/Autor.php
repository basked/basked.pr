<?php

namespace Modules\Directory\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Directory\Entities\Autor
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Directory\Entities\Book[] $books
 * @property-read int|null $books_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Autor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Autor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Autor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Autor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Autor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Autor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Autor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Autor extends Model
{
    protected $fillable = [];

    protected $table='spr_autors';
    public function books(){
    return $this->belongsToMany('Modules\Directory\Entities\Book', 'spr_autor_book','autor_id','book_id')->withPivot('count');
        //           return $this->belongsToMany('spr_books', 'spr_autor_book','autor_id','book_id');
    }
}
