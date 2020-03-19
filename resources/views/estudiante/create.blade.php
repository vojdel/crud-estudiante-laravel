@section('titulo', 'Estudiante - Registrar')

@extends('plantilla.plantilla')

@section('contenido')

    <div class="container pt-5 justify-content-center">
        <form action="{{route('estudiante.store')}}" method="post" name="add_etudiante">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="nombre">Nombres: </label>
                        <input type="text" placeholder="Ingrese nombre" class="form-control" id="nombre" name="nombres">
                            <small id="emailHelp" class="form-text text-muted">Ingresar Primer y Segundo Nombre</small>
                            <span class="text-danger">{{$errors->first('nombres')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellidos: </label>
                        <input type="text" placeholder="Ingrese apellido" class="form-control" id="apellido" name="apellidos">
                            <small id="emailHelp" class="form-text text-muted">Ingresar Primer y Segundo apellido</small>
                            <span class="text-danger">{{$errors->first('apellidos')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="genero">Genero: </label>
                        <select name="genero" id="genero" name="genero">
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                        </select>
                            <span class="text-danger">{{$errors->first('genero')}}</span>
                    </div>
                    <div class="form-group">                        
                        <label for="fdn">Fecha de Nacimiento: </label>
                        <input type="date" class="form-control" id="fdn" name="fechaDeNacimiento">
                            <span class="text-danger">{{$errors->first('fechaDeNacimiento')}}</span>
                    </div>
                    <div class="form-group">                    
                            <label for="direccion">Dirección: </label>
                        <input type="text" placeholder="Ingrese su dirección" class="form-control" id="direccion" name="direccion">
                            <small id="emailHelp" class="form-text text-muted">ejemplo: estado, municipio, parroquia, sector, ...</small>
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
    </div>

@endsection