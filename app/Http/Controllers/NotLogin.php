<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia;
use App\Usuario;
use App\Vehiculo;
use App\Activacion;
use App\Tono;
use App\RevicionTecnica;
use App\Especialidad;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class NotLogin extends Controller
{
    public function verVoluntarios(){

        $cia= Cia::get();
        $usu = Usuario::get();
        return view('visor.index')->with('cia',$cia)->with('usux',$usu);
    }

    public function verVoluntariosTest(){

        $cia= Cia::get();
        $usu = Usuario::get();
        return view('visor.indexbeta')->with('cia',$cia)->with('usux',$usu);
    }


    public function verUniCentral(){

        $cia= Cia::get();
        return view('visor.central')->with('cia',$cia);
    }

    public function volActivos(){
        
        $usu = Usuario::where('estado','A')->get(['id','rol','cia_id','cargo_id','activado','activado_conductor','tipo_conductor','activado_cbi']);

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

   public function myTonoCuartel($cia){
        
        $a = Tono::where('nombre','like','%tono%')
        ->orWhere('nombre',$cia)->get();
        return response()->json($a);

   }

    public function infoUnidad($id){
        $id_deco = Hashids::decode($id)[0];
        $unidad = Vehiculo::find($id_deco);
        
        $revision=RevicionTecnica::where('vehiculo_id',$id_deco)->latest()->first();
        if($revision === null){
            $rev='00-00-0000';
        }else{
            $rev = date('d-m-Y',strtotime($revision->fecha_vencimiento));
        }
        
        $control= public_path("vehiculos/".$unidad->id.'.jpg');
           if (file_exists($control)){
               $foto=url('/vehiculos').'/'.$unidad->id.'.jpg';
            }else{
               $foto=url('/vehiculos').'/avatar.jpg'; 
             }
             
             if($unidad->activacion=='S'){
                $acti='<span class="text-success">Activado</span>';
                $usu=Activacion::where('vehiculo_id',$id_deco)->latest()->first();
                
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
                $btneliminar='';
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
                $usu=Activacion::where('vehiculo_id',$id_deco)->where('estado','N')->latest()->first();
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
    
public function infoxCia($id){

         $cia = Cia::find($id);
         $count = Usuario::where('activado', '=', 'S')->where('estado','A')->where('cia_id','=',$id)->where('activado_conductor','=','N')->count();
         $usu = Usuario::where('activado', '=', 'S')->where('cia_id','=',$id)->where('activado_conductor','=','N')->get();
         $countTotal = Usuario::where('cia_id','=',$id)->count();
         $esp = Especialidad::get();   
         $stringEspecialidades="";

            foreach ($esp as $key) {
                $total = 0;
                $flag = false;
                    foreach ($usu as $k  => $row) {
                        $flag=true;
                        foreach ($row->especialidades as $key_esp) {
                            if($key_esp->id == $key->id){
                                $total++;
                                $flag=false;
                                break;
                            }else{
                                $flag=true;
                            }
                        }
                    }
                 $stringEspecialidades=$stringEspecialidades.$key->descripcion.' (<b>'.$key->clave.'</b>) = <b>'.$total.'</b> <br>';   
                }


                $control= public_path("img/cia_".$cia->numero.'.png');
                if (file_exists($control)){
                    $foto=url('img/cia_').$cia->numero.'.png';
                }else{
                     $foto=url('/usuarios').'/avatar.jpg'; 
                }

        return "<div class='row'>
                    <div class='col-md-6'>
                         <img src='$foto' width='200px' height='200px' class='img-responsive'>
                    </div>
                    <div class='col-md-6'>
                         <b> ".$cia->nombreCompleto()."</b><br>
                         <b>En Cuartel : ".$count." / ".$countTotal."</b> 
                        <hr>
                        <b>ESPECIALIDADES:</b><br>
                        ".$stringEspecialidades."
                    </div>
                </div>";
               
   }

   public function usuariosActivosNuevoVisor($id){

         $cia = Cia::find($id);
         $count = Usuario::where('activado', '=', 'S')->where('estado','A')->where('cia_id','=',$id)->where('activado_conductor','=','N')->count();
         $usu = Usuario::where('activado', '=', 'S')->where('cia_id','=',$id)->where('activado_conductor','=','N')->get();
         $countTotal = Usuario::where('cia_id','=',$id)->count();
         $especial = Especialidad::get();  
         $totalespecialidades="";
         foreach ($especial as $key) {
            $total = 0;
            $flag = false;
                foreach ($usu as $k  => $row) {
                    $flag=true;
                    foreach ($row->especialidades as $key_esp) {
                        if($key_esp->id == $key->id){
                            $total++;
                            $flag=false;
                            break;
                        }else{
                            $flag=true;
                        }
                    }
                }
             $totalespecialidades=$totalespecialidades.$key->descripcion.' (<b>'.$key->clave.'</b>) = <b>'.$total.'</b> <br>';   
            }


    $imp= "<div class='row'>
                <div class='col-md-12 modal_visor'>
                     <b> ".strtoupper($cia->nombreCompleto())."</b>
                     <br>
                     <b>EN CUARTEL : ".$count." / ".$countTotal."</b> 
                    <hr>
                    <b>ESPECIALIDADES:</b><br>
                    ".$totalespecialidades."
                </div>
            </div>
            <br><br>";

         $cia->usuarios();
        foreach($cia->usuariosCargoVisor as $key){
           if($key->activado=='S' && $key->tipo_conductor=='B'){     
                $stringEspecialidades="";
                    foreach($key->especialidades as $esp){
                    $stringEspecialidades=$stringEspecialidades.$esp->descripcion.' (<b>'.$esp->clave.'</b>) <br>';
                    }
                $stringEspecialidades=strtoupper($stringEspecialidades);
                if($key->cargo_id==9){
                    $cargo ="capitan";
                }elseif($key->cargo_id==5 OR $key->cargo_id==6 OR $key->cargo_id==7 OR $key->cargo_id==8 ){
                    $cargo="teniente";
                }elseif($key->cargo_id==13 OR $key->cargo_id==14 OR $key->cargo_id==15){
                    $cargo="comandante";
                }elseif($key->cargo_id==17){
                    $cargo="inspectores";
                }else{
                    $cargo="voluntario";
                }
                if($key->activado_conductor=='S'){
                    $conductor="conductor";
                }else{
                    $conductor="";
                }
                $control= public_path("usuarios/".$key->rol.'.jpg');
                if (file_exists($control)){
                    $foto=url('/usuarios').'/'.$key->rol.'.jpg';
                }else{
                    $foto=url('/usuarios').'/avatar.jpg'; 
                }
                $operador='';
                if (Auth::check()) {
                if(Auth::user()->cargo_id == 24 || Auth::user()->cargo_id == 9 ){
                    $operador="<br><a id='$key->id' class='btn btn-danger op'>Desactivar</a>";
                }
                }
                $imp=$imp."
                <div class='row'>
                    <div class='col-md-6'>
                        <img src='$foto' width='200px' height='150px' class=' $cargo $conductor'>".$operador."
                    </div>
                    <div class='col-md-6'>
                        <b>NOMBRE :</b>".$key->nombreSimple()."<br>
                        <b> CARGO :</b>".$key->cargo->nombre." <b>ROL :</b>".$key->rol."<br>
                        <hr>
                        <b>ESPECIALIDADES:</b><br>
                        ".$stringEspecialidades."
                    </div>
                </div>
                <hr> 
                <br>";        
            }
        }
            return $imp;
                   
    }
    public function operadorActivo(){
 
        //$id = Hashids::decode($id)[0];
        $usu=Usuario::where('operador_activo', '=', 'S')->get();
                $control= public_path("usuarios/".$usu[0]->rol.'.jpg');
                if (file_exists($control)){
                    $foto=url('/usuarios').'/'.$usu[0]->rol.'.jpg';
                }else{
                     $foto=url('/usuarios').'/avatar.jpg'; 
                }
        return "<div class='row'>
                    <div class='col-md-6'>
                         <img src='$foto' width='200px' height='200px' class='img-responsive voluntario'>
                    </div>
                    <div class='col-md-6'>
                         <b>NOMBRE :</b>".$usu[0]->nombreSimple()."<br>
                        <hr>
                    </div>
                </div>";
                
                
               
   }
   public function oficialGuardia(){
 
    //$id = Hashids::decode($id)[0];
        $usu=Usuario::where('comandante_guardia', '=', 'S')->get();
            $control= public_path("usuarios/".$usu[0]->rol.'.jpg');
            if (file_exists($control)){
                $foto=url('/usuarios').'/'.$usu[0]->rol.'.jpg';
            }else{
                 $foto=url('/usuarios').'/avatar.jpg'; 
            }

        $usu2=Usuario::where('capitan_guardia', '=', 'S')->get();
            $control2= public_path("usuarios/".$usu2[0]->rol.'.jpg');
            if (file_exists($control2)){
                $foto2=url('/usuarios').'/'.$usu2[0]->rol.'.jpg';
            }else{
                 $foto2=url('/usuarios').'/avatar.jpg'; 
            }   

    return "<div class='row'>
                <div class='col-md-6'>
                     <img src='$foto' width='200px' height='200px' class='img-responsive comandante'>
                </div>
                <div class='col-md-6'>
                     <b>NOMBRE :</b>".$usu[0]->nombreSimple()."<br>
                     <b> CARGO :</b>".$usu[0]->cargo->nombre." <b>ROL :</b>".$usu[0]->rol."<br>
                    <hr>
                </div>
            </div>
            <hr>
            <div class='row'>
                <div class='col-md-6'>
                     <img src='$foto2' width='200px' height='200px' class='img-responsive capitan'>
                </div>
                <div class='col-md-6'>
                     <b>NOMBRE :</b>".$usu2[0]->nombreSimple()."<br>
                     <b> CARGO :</b>".$usu2[0]->cargo->nombre." <b>ROL :</b>".$usu2[0]->rol."<br>
                    <hr>
                </div>
            </div>";
            
            
           
}
}
