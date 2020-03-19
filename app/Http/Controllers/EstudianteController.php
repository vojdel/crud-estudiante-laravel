<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;
use Redirect;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['estudiantes'] = Estudiante::orderBy('id', 'asc')->paginate(5);
        return view('estudiante.index', $data);
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
            'direccion' => 'required'
        ]);

        Estudiante::create($request->all());

        return redirect()->route('estudiante.index')->with('success', 'Estudiante Registrado Satisfactoriamente.');
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
        $where = array('id' => $id);
        $data['estudiante_info'] = Estudiante::where($where)->first();
        
        return view('estudiante.edit', $data);
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
            'direccion' => 'required'
        ]);
        
        $update = [
        	'nombres' => $request->nombres,
        	'apellidos' => $request->apellidos,
        	'genero' => $request->genero,
        	'fechaDeNacimiento' => $request->fechaDeNacimiento,
        	'direccion' => $request->direccion
        ];
        
        Estudiante::where('id', $id)->update($update);
        
        return Redirect::to('estudiante')->with('success', 'Estudiante actualizado satisfactoriamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
