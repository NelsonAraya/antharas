<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia;
use App\Usuario;
use App\Vehiculo;
use App\Activacion;
use App\Tono;
use App\RevicionTecnica;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class NotLogin extends Controller
{
    public function verVoluntarios(){

        $cia= Cia::get();
        return view('visor.index')->with('cia',$cia);
    }

    public function volActivos(){
        
        $usu = Usuario::where('estado','A')->get(['id','rol','cia_id','cargo_id','activado','activado_conductor','tipo_conductor']);

        return response()->json($usu);
        
    }

    public function cuartelesActivos(){
        
        $veh = Vehiculo::where('estado','A')->get(['id','clave','activacion','estado']);

        foreach($veh as $row ){
            if($row->activacion=='S'){
                $tmp= Vehiculo::find($row->id);
                $id= $tmp->getHashId();
                $row->id2= $id;
                //$conductor=Activacion::where('vehiculo_id',$row->id)->latest()->first();
                //$row->usucia =$row->usu->usuario->cia->nombreCompleto();
                //$row->hora = $row->usu->horaActivacion();
                //$row->conductor = $conductor->usuario->id;
                /*
                if($row->usu->usuario->tipo_conductor=='C'){
                    $row->tipo_conductor='Cuartelero';
                }else{
                    $row->tipo_conductor='Bombero';
                }
                $row->usu= $row->usu->usuario->nombreSimple();
                */
            }else{
                $tmp= Vehiculo::find($row->id);
                $id= $tmp->getHashId();
                $row->id2= $id;
                /*
                 $row->usu=Activacion::where('vehiculo_id',$row->id)
                            ->where('estado','N')->latest()->first();               
                 if(empty($row->usu)){
                    $row->hora="Sin Datos";
                 }else{
                    $row->hora = $row->usu->horaActivacion();
                 } 
                 */ 
            }
        }
        return response()->json($veh);
        
    }
    public function usuariosActivos($id){
        //$id = Hashids::decode($id)[0];
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
                     $foto=url('/usuarios').'/avatar.jpg'; 
                }
                $operador='';
                if (Auth::check()) {
                   if(Auth::user()->cargo_id == 24 || Auth::user()->cargo_id == 9 ){
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
   public function tonoCuartel($nombre){

    $tono = Tono::where('nombre',$nombre)->get();
    $estado="";
    if($tono[0]->estado=='A'){
       $estado='N';
    }else{
        $estado='A';
    }

    $t = Tono::find($tono[0]->id);
    $t->estado=$estado;
    $t->save();
    $a=$nombre;
    return response()->json($a);

   }

   public function eventoCuartel(){
     
     $a = Tono::get();
     return response()->json($a);

   }

    public function infoUnidad($id){
        $id = Hashids::decode($id)[0];
        $unidad = Vehiculo::find($id);
        /*
        $revision=RevicionTecnica::where('vehiculo_id',$id)->latest()->first();
        if($revision === null){
            $rev='00-00-0000';
        }else{
            $rev = date('d-m-Y',strtotime($revision->fecha_vencimiento));
        }
        */
        $control= public_path("vehiculos/".$unidad->id.'.jpg');
           if (file_exists($control)){
               $foto=url('/vehiculos').'/'.$unidad->id.'.jpg';
            }else{
               $foto=url('/vehiculos').'/avatar.jpg'; 
             }
             if($unidad->activacion=='S'){
                $acti='<span class="text-success">Activado</span>';
                $usu=Activacion::where('vehiculo_id',$id)->latest()->first();
                
                $usucia =$usu->usuario->cia->nombreCompleto();
                $hora = $usu->horaActivacion();
                $licencia = date('d-m-Y',strtotime($usu->usuario->fecha_licencia));
                if($usu->usuario->tipo_conductor=='C'){
                    $tipo_conductor='Cuartelero';
                }else{
                    $tipo_conductor='Bombero';
                }
                $conductor=$usu->usuario->id;
                $usu = $usu->usuario->nombreSimple();
                if (Auth::check()) {
                   if(Auth::user()->cargo_id == 24 || Auth::user()->cargo_id == 9 ){
                    $id2=$unidad->getHashId();
                   $btneliminar="<a id='__$id2' data-conductor='$conductor' class='btn btn-danger un'>Desactivar</a>";
                   }
                }
                return "<div class='row'>
                            <div class='col-md-6'>
                                 <img src='$foto' width='200px' height='200px' class='img-responsive'>
                                 PATENTE <b>".$unidad->patente."</b><br>".$btneliminar." 
                            </div>
                            <div class='col-md-6'>
                                 <b>CLAVE :</b>".$unidad->clave."<br>
                                 <b>ESTADO :</b><b>".$acti."</b><br>
                                 <b>REVISION :</b>".$rev."<br>
                                <hr>
                                <b>DATOS CONDUCTOR:</b><br>
                                <b>NOMBRE :</b>".$usu."<br>
                                <b>DOTACION :</b>".$usucia."<br>
                                <b>HORA ACTIVACION :</b>".$hora."<br>
                                <b>LICENCIA :</b>".$licencia."<br>
                                <b>ESTADO :</b>".$tipo_conductor."
                            </div>
                        </div>";             

             }else{
                $acti='<span class="text-danger">Desactivado</span>';
                $usu=Activacion::where('vehiculo_id',$id)->where('estado','N')->latest()->first();
                 if(empty($usu)){
                    $hora="Sin Datos";
                 }else{
                    $hora = $usu->horaActivacion();
                 }
            return "<div class='row'>
                            <div class='col-md-6'>
                                 <img src='$foto' width='200px' height='200px' class='img-responsive'>
                                 PATENTE <b>".$unidad->patente."</b> 
                            </div>
                            <div class='col-md-6'>
                                 <b>CLAVE :</b>".$unidad->clave."<br>
                                 <b>ESTADO :</b><b>".$acti."</b><br>
                                 <b>REVISION :</b>".$rev."<br>
                                <hr>
                                <b>DATOS CONDUCTOR:</b><br>
                                <b>HORA ACTIVACION :</b>".$hora."<br>
                            </div>
                        </div>";   
             }
               
   }
}
