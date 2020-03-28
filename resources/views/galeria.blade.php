@extends('layouts.plantilla')

@section('cabecera')
    <h1>Galería</h1>
@endsection

@section('informacion')
    <h3>Aqui va el contenido de la página</h3>
    @if(count($alumnos))
        <table width="50%" border="1">
            @foreach($alumnos as $personas)
                <tr>
                    <td>{{$personas}}</td>
                </tr>
            @endforeach
    @else
    {{"No hay registros"}}        
        </table>
    @endif
@endsection

@section('pie')
    
@endsection