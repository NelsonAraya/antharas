<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Usuario;
use App\Bitacora;
use Vinkla\Hashids\Facades\Hashids;
class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usu = Usuario::find(auth()->user()->id);
        if($usu->conductor=='S'){
            return view('bitacora.index')->with('usu',$usu);
        }else{
         $veh = Vehiculo::where('cia_id',auth()->user()->cia_id)->where('estado','A')->orderBy('id','ASC')->get();
            return view('bitacora.index')->with('veh',$veh);
        }

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
        $id2 = Hashids::decode($id)[0];
        $bi=Bitacora::where('vehiculo_id',$id2)->latest()->first();
        return view('bitacora.show')->with('veh',$id)->with('bi',$bi);
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
        $request->validate([
            'fecha_salida' => 'required',
            'fecha_llegada' => 'required',
            'hora_salida' => 'required',
            'hora_llegada' => 'required',
            'kmsalida' => 'required',
            'kmllegada' => 'required',
            'conductor_id' => 'required',
            'obac_id' => 'required',
            'servicio' => 'required',
            'direccion' => 'required',
        ]);
        $id = Hashids::decode($id)[0];
        $bitacora = new Bitacora($request->all());
        $bitacora->vehiculo_id=$id;
        $bitacora->save();
        $veh = Vehiculo::find($id);
        session()->flash('info', 'Bitacora Agregada a Unidad '.$veh->clave);

        return redirect()->route('bitacora.index');
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
    public function searchConductor(Request $request){

        $search = $request->term;
        $usu = Usuario::Nombres($search)->where('conductor','S')->get();
       
        $data = [];

        foreach ($usu as $key => $value) {
            $value->nombres = $value->NombreSimple(); 
            $data [] = ['id'=> $value->id, 'value'=> $value->nombres];       
        }
        return response()->json($data);

    }
    
    public function searchObac(Request $request){

        $search = $request->term;
        $usu = Usuario::Nombres($search)->get();
       
        $data = [];

        foreach ($usu as $key => $value) {
            $value->nombres = $value->NombreSimple(); 
            $data [] = ['id'=> $value->id, 'value'=> $value->nombres];       
        }
        return response()->json($data);

    }
    public function verBitacora($id){
        $id = Hashids::decode($id)[0];
        $veh = Vehiculo::find($id);
        $bitacora = Bitacora::where('vehiculo_id',$id)->orderBy('id','ASC')->paginate(10);
         return view('bitacora.ver')->with('bitacora',$bitacora)->with('veh',$veh);
    }
}
