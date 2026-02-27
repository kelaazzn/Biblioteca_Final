<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';
    protected $fillable = ['nombre', 'isbn', 'autor', 'editorial', 'categoria_id', 'estatus'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
