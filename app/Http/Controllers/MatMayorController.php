<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Cia;
class MatMayorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $veh = Vehiculo::Clave($request->q)->orderBy('id','ASC')->paginate(10);
        return view('admin.matmayor.index')->with('veh',$veh);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cia=Cia::pluck('nombre','id');      
        return view('admin.matmayor.create')->with('cia',$cia);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $veh = new  Vehiculo($request->all());
        $veh->patente=strtoupper($veh->patente);
        $veh->clave=strtoupper($veh->clave);
        $veh->modelo=strtoupper($veh->modelo);
        $veh->marca=strtoupper($veh->marca);
        $veh->save();

        session()->flash('info', 'La Unidad '.$veh->clave.' patente:'. $veh->patente.' ha sido creado.');

        return redirect()->route('material_mayor.index');
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
        $veh = Vehiculo::find($id);
        $cia = Cia::pluck('nombre','id'); 
        return view('admin.matmayor.edit')->with('veh',$veh)->with('cia',$cia);
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
