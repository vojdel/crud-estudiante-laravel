<?php

namespace App\Http\Controllers;

use App\Estudiante;
use App\Persona;
use App\Direccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *@param  int  $pag
     *@param  int  $vista
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $pag, $vista, $orden, $tipo)
    {
        if($request->ajax()){

          $ordenBy = 'estudiantes.'.$orden;

          if($orden !== 'id'){
            $ordenBy = 'personas.'.$orden;
          }

            $data = Estudiante::select('estudiantes.id', 'personas.nombres', 'personas.apellidos', 'personas.genero', 'personas.fechaDeNacimiento', 'personas.id_direccion','direccions.direccion', 'direccions.id_parroquia', 'parroquias.parroquia', 'parroquias.id_municipio', 'municipios.municipio', 'municipios.id_estado', 'estados.estado')
                ->join('personas', 'estudiantes.id_persona', '=', 'personas.id')
                ->join('direccions', 'personas.id_direccion', '=', 'direccions.id')
                ->join('parroquias', 'direccions.id_parroquia', '=', 'parroquias.id')
                ->join('municipios', 'parroquias.id_municipio', '=', 'municipios.id')
                ->join('estados', 'municipios.id_estado', '=', 'estados.id')
                ->orderBy($ordenBy, $tipo)
                ->skip(($pag * $vista) - $vista)
                ->take($vista)
                ->get();
                /* skip() para saltar entre la consulta
                *   take() para limitar el resultado
                */

                return $data;
        }
    }

    /**
     * Display a listing of the resource.
     *
     *@param  int  $buscar
     *@param  int  $pag
     *@param  int  $vista
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, $buscar)
    {
        if($request->ajax()){

          $ordenBy = 'estudiantes.'.$orden;

          if($orden !== 'id'){
            $ordenBy = 'personas.'.$orden;
          }

            $data = Estudiante::select('estudiantes.id', 'personas.nombres', 'personas.apellidos', 'personas.genero', 'personas.fechaDeNacimiento', 'personas.direccion')
                ->join('personas', 'estudiantes.id_persona', '=', 'personas.id')
                ->where('personas.nombres', '=', '%'.$buscar.'%')
                ->orderBy('estudiantes.id', 'DESC')
                ->get();
                /* skip() para saltar entre la consulta
                *   take() para limitar el resultado
                */

                return $data;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contar(Request $request)
    {
        if($request->ajax()){

            $data = Estudiante::all()
                ->count();
                /* skip() para saltar entre la consulta
                *   take() para limitar el resultado
                */

                return $data;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estudiante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'genero' => 'required',
            'fechaDeNacimiento' => 'required',
            'direccion' => 'required',
            'id_parroquia' => 'required'
        ]);

        $direccion = new Direccion();
        $direccion->direccion = $request->direccion;
        $direccion->id_parroquia = $request->id_parroquia;
        $direccion->save();

        $persona = new Persona();
        $persona->nombres = $request->nombres;
        $persona->apellidos = $request->apellidos;
        $persona->genero = $request->genero;
        $persona->fechaDeNacimiento = $request->fechaDeNacimiento;
        $persona->id_direccion = $direccion->id;
        $persona->save();

        $estudiante = new Estudiante();
        $estudiante->id_persona = $persona->id;
        $estudiante->id_users = auth()->id();
        $estudiante->save();

        return $estudiante;

        /*$estudiante = new Estudiante();
        $estudiante->nombres = $request->nombres;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->genero = $request->genero;
        $estudiante->fechaDeNacimiento = $request->fechaDeNacimiento;
        $estudiante->direccion = $request->direccion;
        $estudiante->save();

        return $estudiante;*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'genero' => 'required',
            'fechaDeNacimiento' => 'required',
            'id_direccion' => 'required',
            'direccion' => 'required',
            'id_parroquia' => 'required'
        ]);

        $updateDireccion = [
        	'direccion' => $request->direccion,
          'id_parroquia' => $request->id_parroquia
        ];

        $direccion = Direccion::where('id', $request->id_direccion)->update($updateDireccion);

        $update = [
          'nombres' => $request->nombres,
          'apellidos' => $request->apellidos,
          'genero' => $request->genero,
          'fechaDeNacimiento' => $request->fechaDeNacimiento,
          'id_direccion' => $request->id_direccion
        ];

        $persona = Persona::where('id', $id)->update($update);

        return $persona;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::where('id', $id)->delete();
        return $persona;
    }
}
