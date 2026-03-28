<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias';

    public function libros()
    {
        return $this->hasMany(Libro::class, 'categoria_id');
    }
}
