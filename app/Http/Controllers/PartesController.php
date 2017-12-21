<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emergencia;
use App\Clave;
use App\Cia;
use App\EmergenciaCia;
use App\Vehiculo;
use Illuminate\Support\Facades\Auth;
class PartesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emergencia = Emergencia::orderBy('id','DESC')->paginate(10);
        
        return view('partesonline.index')->with('eme',$emergencia);
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
        return view('partesonline.create')->with('clave',$clave)
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
        
        session()->flash('info', 'Emergencia creada Correctamente');

        return redirect()->route('partesonline.index');
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
