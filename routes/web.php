<?php

use App\Articulos;
use App\Cliente;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get("/", "miController@index");
Route::get("/crear", "miController@create");
Route::get("/articulos", "miController@store");
Route::get("/mostrar", "miController@show");
Route::get("/contacto", "miController@contactar");
Route::get("/galeria", "miController@galeria");

Route::get("/insertar", function(){
    DB::insert("INSERT INTO articulos
                (nombre_articulo, precio,pais_origen, seccion, observaciones)
                VALUES(?,?,?,?,?)",
                ['martillo',200, 'Perú', 'FERRETERÍA', 'fdfgsgfjgdsjf']);
});

Route::get("/leer", function(){
    $resultados = DB::select("SELECT * 
                    FROM articulos 
                    WHERE id = ?",
                    [1]);
    foreach ($resultados as $articulo) {
        return $articulo->nombre_articulo;
    }
});

Route::get("/borrar", function(){
    DB::delete("DELETE 
                FROM articulos 
                WHERE id = ?",
                [1]);
});

//SELECT RAW
Route::get("/leer2", function(){
    $articulos = Articulos::all();
    foreach ($articulos as $articulo) {
        echo $articulo->nombre_articulo;
    }
});

//SELECT RAW
Route::get("/leer3", function(){
    $articulos = Articulos::where("pais_origen", "China")
                ->get();
    return $articulos;
    
});

//INSERTAR ELOQUENT Save
Route::get("/insertar2", function(){
    $articulos = new Articulos();
    $articulos->nombre_articulo='Palo de golf';
    $articulos->precio=323;
    $articulos->pais_origen='Perú';
    $articulos->observaciones='hgjhvfdshf';
    $articulos->seccion='DEPORTE';
    $articulos->save();
});

//INSERTAR ELOQUENT Create, Revisar los 'fillable' en clase Articulos
Route::get("/insertar3", function(){
    Articulos::create([
        "nombre_articulo"=>"Impresora",
        "precio"=>543,
        "pais_origen"=>"EE.UU",
        "observaciones"=>"hahdghakdhaskdb",
        "seccion"=>"TECNOLOGÍA"]);
});

//EDITAR ELOQUENT
Route::get("/editar", function(){
    $articulos = Articulos::find(6);
    $articulos->nombre_articulo='Palana';
    $articulos->precio=60;
    $articulos->pais_origen='España';
    $articulos->observaciones='hgjhvdfhdshf';
    $articulos->seccion='FERRETERIA';
    $articulos->save();
});

//EDICION MASIVOS ELOQUENT
Route::get("/editar2", function(){
    Articulos::where('seccion', 'CERÁMICA')
                ->update(['seccion' => 'MENAJE']);
});

//ELIMINAR ELOQUENT
Route::get("/borrar2", function(){
    $articulos = Articulos::find(1);
    $articulos->delete();
});

//ELIMINAR 2 ELOQUENT
Route::get("/borrar3", function(){
    Articulos::where('seccion', 'FERRETERÍA')
                ->delete();
});

//BORRADO LÓGICO CON SolftDelete
Route::get("/borrar4", function(){
    Articulos::find(6)
    ->delete();
});

//BORRADO PERMANENTE
Route::get("/borrar4", function(){
    Articulos::find(6)
    ->forceDelete();
});

//SELECT EN PAPELERA
Route::get("/leer4", function(){
    $articulos = Articulos::withTrashed()
                ->where('id', 6)
                ->get();
    return $articulos; 
});
  //Solo los borrados
Route::get("/leer5", function(){
    $articulos = Articulos::onlyTrashed()
                ->get();
    return $articulos; 
});

//RESTAURAR ELEMENTO BORRADO
Route::get("/restaurar", function(){
    Articulos::withTrashed()
            ->where('id', 6)
            ->restore();
});

//RELACIONES UNO A UNO
Route::get("/cliente/3/articulos", function(){
    return Cliente::find(3)->articulos;
});

//RELACIONES INVERSA UNO A UNO -> BelongTo
Route::get("/articulos/{id}/cliente", function($id){
    return Articulos::find($id)->cliente;
});

//RELACIONES UNO A MUCHOS
Route::get("/articulos", function(){
    $articuloss = Cliente::find(3)->articuloss;
    foreach ($articuloss as $articulo) {
        echo $articulo->nombre_articulo."<br>";
    }
});

//RELACIONES MUCHOS A MUCHOS
Route::get("/cliente/{id}/perfil", function($id){
    $cliente = Cliente::find($id);
    foreach ($cliente->perfils as $perfil) {
        echo $perfil->nombre."<br>";
    }
});

Route::get("/calificaciones", function(){
    $cliente = Cliente::find(1);
    //$articulos = Articulos::find(4);
    //foreach ($articulos->calificaciones as $calificacion) {
    foreach ($cliente->calificaciones as $calificacion) {
        return $calificacion->calificacion;
    }
});