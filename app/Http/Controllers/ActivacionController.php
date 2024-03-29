<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Activacion;
use App\Vehiculo;
use App\Cia;
use App\RevicionTecnica;
use App\Logactivacion;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
class ActivacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usu = Usuario::find(Auth::user()->id);
        if($usu->conductor=='S'){
            if(count($usu->vehiculos)>=1){
                foreach ($usu->vehiculos as $key =>  $row) {              
                    $b[$key]=RevicionTecnica::where('vehiculo_id',$row->id)->latest()->first();
                    if($row->activacion=='S'){
                        $a[$key]=Activacion::where('vehiculo_id',$row->id)->latest()->first();
                        $cantidad_material=0;
                        foreach ($a as $key => $ind) {
                            if($ind->usuario_id==Auth::user()->id){
                                $cantidad_material++;
                            }
                        }
                    }
                }
                if(empty($a)){
                    return view('activacion.index')->with('usu',$usu)->with('rev',$b);
                }else{
                    return view('activacion.index')->with('usu',$usu)
                    ->with('conductor',$a)->with('rev',$b)->with('myactivo',$cantidad_material); 
                }
            }else{
             session()->flash('danger', 'Usted no tiene ninguna Unidad Asignada');
             return redirect()->route('home'); 
            }
        }else{
             session()->flash('danger', 'Usted no esta habilitado como Conductor');
             return redirect()->route('home');
        }

    }

    public function activacion($usu,$veh,$estado){
        
        $usu = Hashids::decode($usu)[0];
        $veh = Hashids::decode($veh)[0];
        $acti = new Activacion();
        $vehiculo = Vehiculo::find($veh);
        $u = Usuario::find($usu);

        $acti->usuario_id=$usu;
        $acti->vehiculo_id=$veh;
        $acti->estado=$estado;
        $acti->tipo=$u->tipo_conductor;
        $acti->save();
        $vehiculo->activacion=$estado;
        $vehiculo->save();

        $u->activado = $estado;
        $u->activado_conductor = $estado;
        $u->save();
        
        $log = new Logactivacion();
        $flag=Logactivacion::where('usuario_id',$usu)->latest()->first();

        if(is_null($flag)){

            $log->usuario_id=$usu;
            $log->estado=$estado;
            $log->save();

        }
        elseif($flag->estado!=$estado){

            $log->usuario_id=$usu;
            $log->estado=$estado;
            $log->save();

        }

        if($estado == 'S'){
            $a="Activado";
        }else{
            $a="Desactivado";
        }
        session()->flash('info', 'Unidad '.$vehiculo->clave.' ha sido '.$a.' correctamente');

        return redirect()->route('activacion.index');

    }

    public function showCuarteles(){

        //$cia= Cia::where('numero','!=',100)->get();
        $cia= Cia::get();
        return view('activacion.show')->with('cia',$cia);
    }

    public function cuartelesActivos(){
        
        $veh = Vehiculo::where('estado','A')->get();

        foreach($veh as $row ){
            if($row->activacion=='S'){
                $row->usu=Activacion::where('vehiculo_id',$row->id)->latest()->first();
                $row->usucia =$row->usu->usuario->cia->nombreCompleto();
                $row->usu= $row->usu->usuario->nombreSimple();
                
            }
        }
        return response()->json($veh);
        
    }
    public function tipo_conductor($usuario,$tipo){

         $id = Hashids::decode($usuario)[0];
         $u = Usuario::find($id);
         $u->tipo_conductor = $tipo;
         $u->save();
         if($tipo=='C'){
            $t="Cuartelero";
         }
         else {
             $t="Bombero";
         }


         session()->flash('info', 'Su estado de Conductor ahora es '.$t);

        return redirect()->route('activacion.index');
        
    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
