<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Activacion;
use App\Vehiculo;
use Illuminate\Support\Facades\Auth;
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
        foreach ($usu->vehiculos as $key =>  $row) {
            if($row->activacion=='S'){
                $a[$key]=Activacion::where('vehiculo_id',$row->id)->latest()->first();
            }
        }
        if(empty($a)){
            return view('activacion.index')->with('usu',$usu);
        }else{
            return view('activacion.index')->with('usu',$usu)->with('conductor',$a); 
        }

    }

    public function activacion($usu,$veh,$estado){
        
        $acti = new  Activacion();
        $vehiculo = Vehiculo::find($veh);
        $acti->usuario_id=$usu;
        $acti->vehiculo_id=$veh;
        $acti->estado=$estado;

        $acti->save();
        $vehiculo->activacion=$estado;
        $vehiculo->save();
        if($estado == 'S'){
            $a="Activado";
        }else{
            $a="Desactivado";
        }
        session()->flash('info', 'Unidad '.$vehiculo->clave.' ha sido '.$a.' correctamente');

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
