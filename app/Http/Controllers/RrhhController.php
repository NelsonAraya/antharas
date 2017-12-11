<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia;
use App\Cargo;
use App\Usuario;
class RrhhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Usuario::orderBy('rol','ASC')->paginate(10);
        return view('rrhh.usuarios.index')->with('usu',$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cia=Cia::pluck('nombre','id');
        $cargo=Cargo::pluck('nombre','id');
        return view('rrhh.usuarios.create')
                ->with('cia',$cia)
                ->with('cargo',$cargo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usu = new Usuario($request->all());
        
        if($request->conductor=="si"){
            $usu->conductor='S';
        }else{
            $usu->conductor='N';
        }

        $run = str_replace('.','',$request->run);
        $run = str_replace('-','',$request->run);

        $dv = substr($run, -1);
        $id = substr($run, 0, -1);

        $usu->id=$id;
        $usu->dv= $dv;
        $usu->password = bcrypt($id);
        $usu->save();

        session()->flash('success', 'El usuario '.$usu->nombreSimple().' ha sido creado.');

        return redirect()->route('usuarios.index');
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
        $usuario = Usuario::find($id);

        $cia=Cia::pluck('nombre','id');
        $cargo=Cargo::pluck('nombre','id');
        
        return view('rrhh.usuarios.edit')
                ->with('cia',$cia)
                ->with('cargo',$cargo)
                ->with('usu',$usuario);
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
        $usu = Usuario::find($id);
        $usu->fill($request->all());
        if($request->conductor=="si"){
            $usu->conductor='S';
        }else{
            $usu->conductor='N';
        }

        $usu->save();

        session()->flash('info', 'El usuario '.$usu->nombreSimple().' ha sido Modificado.');

        return redirect()->route('usuarios.index');
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
