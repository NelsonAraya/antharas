<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia;
use App\Cargo;
use App\Usuario;
use App\Role;
class RrhhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuario = Usuario::Nombres($request->q)->orderBy('rol','Asc')->paginate(10);
        //$usuario = Usuario::orderBy('rol','ASC')->paginate(10);
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
        $request->validate([
            'run' => 'required',
            'nombres' => 'required|string',
            'apellidop' => 'required',
            'apellidom' => 'required',
            'cia_id' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'cargo_id' => 'required',
            'conductor' => 'required',
        ]);
        
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
    public function roles($id){
        
        $usu = Usuario::find($id);
        $rol = Role::pluck('descripcion','id');
        return view('rrhh.usuarios.roles')->with('usu',$usu)->with('roles',$rol);
    }

    public function permisos(Request $request,$id){

        $usu = Usuario::find($id);
        $usu->roles()->detach();

        foreach ((array)$request->roles as $row){
              $usu->roles()->attach($row);
        }

        session()->flash('info', 'Permisos Actualizados Correctamente');

        return redirect()->route('usuarios.roles',$usu->id);
        
    }
}
