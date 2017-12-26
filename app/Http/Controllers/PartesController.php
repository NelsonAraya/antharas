<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emergencia;
use App\EmergenciaCia;
use App\Usuario;
use App\ParteOnline;
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
        $eme = EmergenciaCia::where('cia_id',Auth::user()->cia_id)->orderBy('id','DESC')->paginate(10);
        return view('partesonline.index')->with('eme',$eme);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $eme = Emergencia::find($id);
        $obac_cia =Usuario::where('cia_id',Auth::user()->cia_id)->get();
        $obac_cbi =Usuario::where('cia_id','!=',11)->get();
        return view('partesonline.show')->with('eme',$eme)
                ->with('obac_cia',$obac_cia)->with('obac_cbi',$obac_cbi);
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
        $parte=ParteOnline::where('cia_id',Auth::user()->cia_id)
                ->whereYear('created_at',date('Y'))->latest()->first();
        if($parte==null){
            $numero=1;
        }else{
            $numero=$parte->numero+1;
        }
        $online=new ParteOnline($request->all());
        $online->emergencia_id=$id;
        $online->cia_id=Auth::user()->cia_id;
        $online->numero=$numero;
        $online->usuario_responsable=Auth::user()->id;

        $run_afectado = str_replace('.','',$request->run_afectado);
        $run_afectado = str_replace('-','',$request->run_afectado);
        $run = substr($run_afectado, 0, -1).'-'.substr($run_afectado, -1);
        $online->run_afectado=$run;
        $online->save();

        session()->flash('info', 'Parte Online Creado Correctamente');

        return redirect()->route('partesonline.index');

    }
    public function lista($id){
        $parte = ParteOnline::find($id);
        $usu = Usuario::where('cia_id',Auth::user()->cia_id)->orderBy('rol','ASC')->get();
        return view('partesonline.lista')->with('parte',$parte)->with('usu',$usu);

    }
    public function listaParte(Request $request, $id){

        dd($id);

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
