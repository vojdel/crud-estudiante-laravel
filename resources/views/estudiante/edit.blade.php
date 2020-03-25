@section('titulo', 'Estudiante - Editar')

@extends('plantilla.plantilla')

@section('encabezado')

<h2 class="card-title">Editar Estudiante</h2>

@endsection

@section('contenido')

        <form action="{{route('estudiante.update', $estudiante_info->id)}}" method="post" name="add_etudiante">
        {{ csrf_field() }}
        @method('PATCH')
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="nombre">Nombres: </label>
                        <input type="text" placeholder="Ingrese nombre" class="form-control" id="nombre" name="nombres" value="{{$estudiante_info->nombres}}">
                            <span class="text-danger">{{$errors->first('nombres')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellidos: </label>
                        <input type="text" placeholder="Ingrese apellido" class="form-control" id="apellido" name="apellidos" value="{{$estudiante_info->apellidos}}">
                            <span class="text-danger">{{$errors->first('apellidos')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="genero">Genero: </label>
                        <select name="genero" id="genero" name="genero">
                            @if($estudiante_info->genero == "hombre")
                            <option value="hombre" selected>Hombre</option>
                            <option value="mujer">Mujer</option>
                            @else
                            <option value="hombre">Hombre</option>
                            <option value="mujer" selectd>Mujer</option>
                            @endif
                        </select>
                            <span class="text-danger">{{$errors->first('genero')}}</span>
                    </div>
                    <div class="form-group">                        
                        <label for="fdn">Fecha de Nacimiento: </label>
                        <input type="date" class="form-control" id="fdn" name="fechaDeNacimiento" value="{{$estudiante_info->fechaDeNacimiento}}">
                            <span class="text-danger">{{$errors->first('fechaDeNacimiento')}}</span>
                    </div>
                    <div class="form-group">                    
                            <label for="direccion">Dirección: </label>
                        <input type="text" placeholder="Ingrese su dirección" class="form-control" id="direccion" name="direccion" value="{{$estudiante_info->direccion}}">
                            <span class="text-danger">{{$errors->first('direccion')}}</span>
                    </div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </form>


@endsection