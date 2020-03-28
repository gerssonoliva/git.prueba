<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ["nombre", "apellido"];//dar permisos a tinker de insertar datos en la BD
    /*
    public function articulos() {
        return $this->hasOne("App\Articulos");
    }

    public function articuloss() {
        return $this->hasMany('App\Articulos');
    }

    public function perfils(){
        return $this->belongsToMany("App\Perfil");
    }
    */
    public function calificaciones() {
        return $this->morphMany("App\Calificaciones", "calificacion");
    }
}
