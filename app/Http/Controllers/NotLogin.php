<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia;
use App\Usuario;
use App\Vehiculo;
use App\Activacion;
class NotLogin extends Controller
{
    public function verVoluntarios(){

        $cia= Cia::get();
        return view('visor.index')->with('cia',$cia);
    }

    public function volActivos(){
        
        $usu = Usuario::where('estado','A')->get(['id','rol','cia_id','cargo_id','activado']);

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
}
