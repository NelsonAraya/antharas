<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emergencia;
use App\Clave;
use App\Cia;
use App\EmergenciaCia;
use App\Vehiculo;
use App\EmergenciaUnidad;
use App\ParteOnline;
use Illuminate\Support\Facades\Auth;
class EmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emergencia = Emergencia::orderBy('id','DESC')->paginate(10);
        
        return view('emergencia.index')->with('eme',$emergencia);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clave=Clave::pluck('clave','id');
        $cia=Cia::pluck('nombre','id');
        $veh = Vehiculo::where('estado','A')->get();
        return view('emergencia.create')->with('clave',$clave)
                ->with('cia',$cia)->with('veh',$veh);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eme = new Emergencia($request->all());
        $eme->usuario_id=Auth::user()->id;
        $eme->save();

        foreach ($request->cias as  $row) {
            $eme_cia = new EmergenciaCia();
            $eme_cia->emergencia_id=$eme->id;
            $eme_cia->cia_id=$row;
            $eme_cia->save();
        }

        foreach ($request->uni as  $row) {
            $uni_cia = new EmergenciaUnidad();
            $uni_cia->emergencia_id=$eme->id;
            $uni_cia->vehiculo_id=$row;
            $uni_cia->save();
        }
        
        session()->flash('info', 'Emergencia creada Correctamente');

        return redirect()->route('emergencia.index');
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
        $eme = Emergencia::find($id);
        $cia=Cia::pluck('nombre','id');
        $veh = Vehiculo::where('estado','A')->get();
        $parte = ParteOnline::where('emergencia_id',$id)->where('estado','T')->get();
        $clave=Clave::pluck('clave','id');
        return view ('emergencia.edit')->with('eme',$eme)
                    ->with('cia',$cia)->with('veh',$veh)
                    ->with('clave',$clave)->with('parte',$parte);
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
        $eme = Emergencia::find($id);
        $eme->fill($request->all());
        $eme->save();

        EmergenciaCia::where('emergencia_id',$id)->delete();
        foreach ($request->cias as  $row) {
            $eme_cia = new EmergenciaCia();
            $eme_cia->emergencia_id=$eme->id;
            $eme_cia->cia_id=$row;
            $eme_cia->save();
        }
        EmergenciaUnidad::where('emergencia_id',$id)->delete();
        foreach ($request->uni as  $row) {
            $uni_cia = new EmergenciaUnidad();
            $uni_cia->emergencia_id=$eme->id;
            $uni_cia->vehiculo_id=$row;
            $uni_cia->save();
        }

        session()->flash('info', 'Emergencia Modificada Correctamente');

        return redirect()->route('emergencia.index');
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
