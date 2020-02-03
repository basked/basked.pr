<?php

namespace Modules\Directory\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Directory\Entities\Book
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Directory\Entities\Autor[] $autors
 * @property-read int|null $autors_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Book whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Directory\Entities\Book whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    protected $fillable = [];
    protected $table='spr_books';
    public function autors(){
    return $this->belongsToMany('Modules\Directory\Entities\Autor', 'spr_autor_book','book_id','autor_id')->withPivot('count');
        //        return $this->belongsToMany('spr_autors', 'spr_autor_book','book_id','autor_id');
    }
}
