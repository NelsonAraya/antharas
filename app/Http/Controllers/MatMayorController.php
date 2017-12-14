<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Cia;
use App\PermisoCirculacion;
use App\RevicionTecnica;
use App\SeguroVehiculo;
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
        $rev = RevicionTecnica::where('vehiculo_id',$id)->
        orderBy('id','DESC')->paginate(3,['*'],'revision');
        $per = PermisoCirculacion::where('vehiculo_id',$id)->
        orderBy('id','DESC')->paginate(3,['*'],'permiso');
        $seg = SeguroVehiculo::where('vehiculo_id',$id)->
        orderBy('id','DESC')->paginate(3,['*'],'seguro');
        return view('admin.matmayor.edit')->with('veh',$veh)
                ->with('cia',$cia)->with('rev',$rev)
                ->with('per',$per)->with('seg',$seg);
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
        $veh = Vehiculo::find($id);
        $veh->fill($request->all());
        $veh->patente=strtoupper($veh->patente);
        $veh->clave=strtoupper($veh->clave);
        $veh->modelo=strtoupper($veh->modelo);
        $veh->marca=strtoupper($veh->marca);
        $veh->save();

        session()->flash('info', 'La Unidad '.$veh->clave.' patente:'. $veh->patente.' ha sido Modificado.');

        return redirect()->route('material_mayor.index');

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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revision(Request $request, $id)
    {
        $rev = new RevicionTecnica();
        $rev->fecha_vencimiento=$request->fecha_vencimiento;
        $rev->vehiculo_id=$id;
        $rev->save();

        session()->flash('info', 'Revision Tecnica Agregada Correctamente');

        return redirect()->route('material_mayor.edit',$id);
    }

    public function permiso(Request $request, $id)
    {
        $rev = new PermisoCirculacion();
        $rev->fecha_vencimiento=$request->fecha_vencimiento;
        $rev->vehiculo_id=$id;
        $rev->save();

        session()->flash('info', 'Permiso de Circulacion Agregado Correctamente');

        return redirect()->route('material_mayor.edit',$id);
    }
    public function seguro(Request $request, $id)
    {
        $rev = new SeguroVehiculo();
        $rev->fecha_vencimiento=$request->fecha_vencimiento;
        $rev->vehiculo_id=$id;
        $rev->save();

        session()->flash('info', 'Seguro Agregado Correctamente');

        return redirect()->route('material_mayor.edit',$id);
    }
}
