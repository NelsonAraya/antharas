<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia;
use App\Usuario;
use App\Vehiculo;
use App\Activacion;
use Illuminate\Support\Facades\Auth;
class NotLogin extends Controller
{
    public function verVoluntarios(){

        $cia= Cia::get();
        return view('visor.index')->with('cia',$cia);
    }

    public function volActivos(){
        
        $usu = Usuario::where('estado','A')->get(['id','rol','cia_id','cargo_id','activado','activado_conductor']);

        return response()->json($usu);
        
    }

    public function cuartelesActivos(){
        
        $veh = Vehiculo::where('estado','A')->get(['id','clave','activacion','estado']);

        foreach($veh as $row ){
            if($row->activacion=='S'){
                $row->usu=Activacion::where('vehiculo_id',$row->id)->latest()->first();
                $row->usucia =$row->usu->usuario->cia->nombreCompleto();
                $row->hora = $row->usu->horaActivacion();
                $row->conductor = $row->usu->usuario->id;
                $row->usu= $row->usu->usuario->nombreSimple();
            }else{
                 $row->usu=Activacion::where('vehiculo_id',$row->id)->where('estado','N')->latest()->first();
                 if(empty($row->usu)){
                    $row->hora="Sin Datos";
                 }else{
                    $row->hora = $row->usu->horaActivacion();
                 }  
            }
        }
        return response()->json($veh);
        
    }
    public function usuariosActivos($id){
        $usu = Usuario::find($id);
        $stringEspecialidades="";
        foreach ($usu->especialidades as $key) {
                 $stringEspecialidades=$stringEspecialidades.$key->descripcion.' (<b>'.$key->clave.'</b>) <br>';   
                }
                $stringEspecialidades=strtoupper($stringEspecialidades);
                if($usu->cargo_id==9){
                    $cargo ="capitan";
                }elseif($usu->cargo_id==5 OR $usu->cargo_id==6 OR $usu->cargo_id==7 OR $usu->cargo_id==8 ){
                    $cargo="teniente";
                }elseif($usu->cargo_id==13 OR $usu->cargo_id==14 OR $usu->cargo_id==15){
                    $cargo="comandante";
                }elseif($usu->cargo_id==17){
                    $cargo="inspectores";
                }else{
                    $cargo="voluntario";
                }
                if($usu->activado_conductor=='S'){
                    $conductor="conductor";
                }else{
                    $conductor="";
                }

                $control= public_path("usuarios/".$usu->rol.'.jpg');
                if (file_exists($control)){
                    $foto=url('/usuarios').'/'.$usu->rol.'.jpg';
                }else{
                     $foto=url('/usuarios').'/avatar.jpg';                }
                $operador='';
                if (Auth::check()) {
                   if(Auth::user()->cargo_id == 24){
                    $operador="<br><a id='$usu->id' class='btn btn-danger op'>Desactivar</a>";
                   }
                }
        return "<div class='row'>
                    <div class='col-md-6'>
                         <img src='$foto' width='200px' height='200px' class='img-responsive $cargo $conductor'>".$operador."
                    </div>
                    <div class='col-md-6'>
                         <b>NOMBRE :</b>".$usu->nombreSimple()."<br>
                         <b> CARGO :</b>".$usu->cargo->nombre." <b>ROL :</b>".$usu->rol."<br>
                        <hr>
                        <b>ESPECIALIDADES:</b><br>
                         ".$stringEspecialidades."
                    </div>
                </div>";
               
   }
}
