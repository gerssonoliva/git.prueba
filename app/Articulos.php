<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulos extends Model
{
    use SoftDeletes;
    protected $table = "articulos";
    /*
    //Permiso para manipular registros en masa
    protected $fillable = [
        'nombre_articulo',
        'precio',
        'pais_origen',
        'observaciones',
        'seccion'
    ];

    public function cliente(){
        return $this->belongsTo("App\Cliente");
    }
    */
    public function calificaciones() {
        return $this->morphMany("App\Calificaciones", "calificacion");
    }
}
