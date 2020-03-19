@section('titulo', 'Estudiante - Indice')

@extends('plantilla.plantilla')

@section('contenido')

    <div class="container pt-5">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2 pr-3">
                <a href="{{ route('estudiante.create') }}" 
                class="btn btn-success float-right pr-1"> <span class="fa fa-plus"></span> Agregar</a>
            </div>
            <br>
            <div class="col-12 pt-1">
                <table class="table table-bordered" id="laravel-crud">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Genero</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Dirección</th>
                            <th>Fecha de Creación</th>
                            <th colspan="2">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estudiantes as $estudiante)

                       <tr>
                             <td>{{$estudiante->id}}</td>
                        <td>{{$estudiante->nombres}}</td>
                        <td>{{$estudiante->apellidos}}</td>
                        <td>{{$estudiante->genero}}</td>
                        <td>{{$estudiante->fechaDeNacimiento}}</td>
                        <td>{{$estudiante->direccion}}</td>
                        <td>{{date('Y-m-d', strtotime($estudiante->created_at))}}</td>
                        <td>
                            <a href="{{ route('estudiante.edit',  $estudiante->id) }}"
                             class="btn btn-primary"> <span class="fa fa-edit" title="Editar"></span></a>
                        </td>
                        <td>
                            <form action="#" method="post">
                                <button class="btn btn-danger" type="submit"> <span class="fa fa-trash" title="Eliminar"></span></button>
                            </form>
                        </td>
                       </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $estudiantes->links() }}
            </div>
        </div>
    </div>

@endsection