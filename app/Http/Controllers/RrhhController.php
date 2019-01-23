<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia;
use App\Cargo;
use App\Usuario;
use App\Role;
use App\Emergencia;
use App\Especialidad;
use App\GrupoSanguineo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $grupo=GrupoSanguineo::pluck('nombre','id');
        return view('rrhh.usuarios.create')
                ->with('cia',$cia)
                ->with('cargo',$cargo)
                ->with('grupo',$grupo);
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
            'cargo_id' => 'required',
            'conductor' => 'required',
            'fecha_nacimiento' => 'required',
            'fecha_ingresocbi' => 'required',
            'operativo' => 'required',
            'sanguineo_id' => 'required',
        ]);
        
        $usu = new Usuario($request->all());
        
        if($request->conductor=="si"){
            $usu->conductor='S';
        }else{
            $usu->conductor='N';
        }
        if(isset($request->email)){
            $usu->email = strtolower($request->email);
        }else{
            $usu->email= null;
        }

        if(isset($request->rol)){
            $usu->rol = $request->rol;
        }else{
            $usu->rol= null;
        }

        $usu->nombres = strtolower($usu->nombres);
        $usu->apellidop = strtolower($usu->apellidop);
        $usu->apellidom = strtolower($usu->apellidom);
        $usu->direccion = strtolower($usu->direccion);

        $run = str_replace('.','',$request->run);
        $run = str_replace('-','',$run);

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
         $grupo=GrupoSanguineo::pluck('nombre','id');
        return view('rrhh.usuarios.edit')
                ->with('cia',$cia)
                ->with('cargo',$cargo)
                ->with('usu',$usuario)
                ->with('grupo',$grupo);
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
            'run' => 'required',
            'nombres' => 'required|string',
            'apellidop' => 'required',
            'apellidom' => 'required',
            'cia_id' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'cargo_id' => 'required',
            'conductor' => 'required',
            'fecha_nacimiento' => 'required',
            'fecha_ingresocbi' => 'required',
            'operativo' => 'required',
        ]);

        $usu = Usuario::find($id);
        $usu->fill($request->all());
        if($request->conductor=="si"){
            $usu->conductor='S';
        }else{
            $usu->conductor='N';
        }
        
        if(isset($request->email)){
            $usu->email = strtolower($request->email);
        }else{
            $usu->email= null;
        }

        if(isset($request->rol)){
            $usu->rol = $request->rol;
        }else{
            $usu->rol= null;
        }

        $usu->nombres = strtolower($usu->nombres);
        $usu->apellidop = strtolower($usu->apellidop);
        $usu->apellidom = strtolower($usu->apellidom);
        $usu->direccion = strtolower($usu->direccion);
        
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
    public function asistencia(){
        $cia = Cia::where('numero','!=',100)->orderBy('numero','ASC')->get();
        return view('rrhh.usuarios.show')->with('cia',$cia);
    }
    public function asistenciaLista(Request $request){

        $request->validate([
            'tipo' => 'required',
            'cia_id' => 'required',
        ]);
         $cia_array = Cia::where('numero','!=',100)->orderBy('numero','ASC')->get();
         $nom_cia=Cia::find($request->cia_id);
        if($request->tipo==1){
            
            $request->validate([
            'inicio' => 'required',
            'termino'=> 'required',
            ]);

            $obj_eme=Emergencia::whereBetween('fecha_emergencia',[$request->inicio,$request->termino])->get();
            $cantidad=0;
                foreach ($obj_eme as $row) {
                    foreach ($row->cias as $cia) {
                        if($cia->cia_id==$request->cia_id){
                            $cantidad++;
                        }
                    }
                }
            $eme = Emergencia::whereBetween('fecha_emergencia',[$request->inicio,$request->termino])->get();
            $usu = Usuario::where('cia_id',$request->cia_id)->orderBy('rol','ASC')->get();
            foreach ($usu as $key => $row) {
                $usu[$key]->asistido=0;
                $usu[$key]->porcentaje=0;
                foreach ($eme as $emergencia) {
                    foreach ($emergencia->partes as $partes) {
                        if($partes->cia_id==$request->cia_id){
                            foreach ($partes->asistencias as $asis) {
                               if($asis->usuario_id==$row->id){
                                    $usu[$key]->asistido++;
                               }
                            }
                        }
                    }
                }
                if($cantidad==0){
                  $usu[$key]->porcentaje=0;  
                }else{
                $usu[$key]->porcentaje = round(($usu[$key]->asistido*100)/$cantidad,1);
                }
            }      
            return view ('rrhh.usuarios.show')->with('usu',$usu)
                    ->with('cantidad',$cantidad)->with('cia',$cia_array)
                    ->with('nom_cia',$nom_cia);
        }else{
            $request->validate([
            'anio' => 'required',
            ]);

            $obj_eme = Emergencia::whereYear('fecha_emergencia',$request->anio)->get();
            $cantidad=0;
                foreach ($obj_eme as $row) {
                    foreach ($row->cias as $cia) {
                        if($cia->cia_id==$request->cia_id){
                            $cantidad++;
                        }
                    }
                }
            $eme = Emergencia::whereYear('fecha_emergencia',$request->anio)->get();
            $usu = Usuario::where('cia_id',$request->cia_id)->orderBy('rol','ASC')->get();
            foreach ($usu as $key => $row) {
                $usu[$key]->asistido=0;
                $usu[$key]->porcentaje=0;
                foreach ($eme as $emergencia) {
                    foreach ($emergencia->partes as $partes) {
                        if($partes->cia_id==$request->cia_id){
                            foreach ($partes->asistencias as $asis) {
                               if($asis->usuario_id==$row->id){
                                    $usu[$key]->asistido++;
                               }
                            }
                        }
                    }
                }
                if($cantidad==0){
                  $usu[$key]->porcentaje=0;  
                }else{
                  $usu[$key]->porcentaje = round(($usu[$key]->asistido*100)/$cantidad,1);
                }
            }
            return view ('rrhh.usuarios.show')->with('usu',$usu)
                        ->with('cantidad',$cantidad)->with('cia',$cia_array)
                        ->with('nom_cia',$nom_cia);
        }

    }

    public function restablecerPassword($id){

        $usu = Usuario::find($id);
        $usu->password = bcrypt($id);
        $usu->save();

        session()->flash('info', 'Contraseña Restablecida a '.$usu->nombreSimple());

        return redirect()->route('usuarios.index');
    }

    public function changePassword(){
        
        return view('rrhh.usuarios.change'); 
    }
    public function nuevaPassword(Request $request){
        $request->validate([
            'password' => 'required',
            'nueva_password' => 'required|string|min:6|max:12',
            'nueva_password2' => 'required|string|min:6|max:12',
        ]);  
        
        if(Hash::check($request->password,Auth::user()->password)){
            
            if($request->nueva_password!=$request->nueva_password2){
             
             session()->flash('danger', 'Contraseñas no coinciden');

             return redirect()->route('home');
            }
            else{
                 $usu = Usuario::find(Auth::user()->id);
                 $usu->password = bcrypt($request->nueva_password);
                 $usu->save();
                
                 session()->flash('info', 'Contraseñas Cambiada con Exito!');

                return redirect()->route('home');
            }
        }else{

            session()->flash('danger', 'Contraseña Incorrecta');

            return redirect()->route('home');
        }
    }
    public function especialidad($id){

        $usu = Usuario::find($id);
        $esp = Especialidad::pluck('descripcion','id');      
        return view('rrhh.usuarios.especialidad')->with('usu',$usu)->with('esp',$esp);
    }

    public function updateEspecialidad(Request $request,$id){

        $usu = Usuario::find($id);
        $usu->especialidades()->detach();

        foreach ((array)$request->especialidades as $row){
              $usu->especialidades()->attach($row);
        }

        session()->flash('info', 'Especialiades Actualizados Correctamente');

        return redirect()->route('usuarios.especialidad',$usu->id);
        
    }
}
