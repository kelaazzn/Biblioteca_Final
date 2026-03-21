<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Libro;
use App\Models\Usuario;

class Prestamo extends Model
{
    protected $table_name = 'prestamos';

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
