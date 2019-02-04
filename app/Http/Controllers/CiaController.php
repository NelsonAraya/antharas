<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\ParteOnline;
use App\ParteAsistencia;
use App\Emergencia;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
class CiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuario = Usuario::Nombres($request->q)
        ->where('cia_id',Auth::user()->cia_id)->orderBy('rol','Asc')->paginate(10);
        //$usuario = Usuario::orderBy('rol','ASC')->paginate(10);
        return view('cia.index')->with('usu',$usuario);
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
        $id = Hashids::decode($id)[0];
        $cia = Cia::find($id);
        return view ('cia.show')->with('cia',$cia);
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
    public function busqueda()
    {
        return view ('cia.show');

    }
    public function busquedalista(Request $request,$id){

        $request->validate([
            'tipo' => 'required',
        ]);

        if($request->tipo==1){
            
            $request->validate([
            'inicio' => 'required',
            'termino'=> 'required',
            ]);
            
            $id = Hashids::decode($id)[0];

            $obj_eme=Emergencia::whereBetween('fecha_emergencia',[$request->inicio,$request->termino])->get();
                $cantidad=0;
                foreach ($obj_eme as $row) {
                    foreach ($row->cias as $cia) {
                        if($cia->cia_id==$id){
                            $cantidad++;
                        }
                    }
                }
            $eme = Emergencia::whereBetween('fecha_emergencia',[$request->inicio,$request->termino])->get();
            $usu = Usuario::where('cia_id',$id)->orderBy('rol','ASC')->get();
            foreach ($usu as $key => $row) {
                $usu[$key]->asistido=0;
                $usu[$key]->porcentaje=0;
                foreach ($eme as $emergencia) {
                    foreach ($emergencia->partes as $partes) {
                        if($partes->cia_id==$id){
                            foreach ($partes->asistencias as $asis) {
                               if($asis->usuario_id==$row->id){
                                    $usu[$key]->asistido++;
                               }
                            }
                        }
                    }
                }
                if($cantidad==0){
                  $usu[$key]->porcentaje=0;  
                }else{
                $usu[$key]->porcentaje = round(($usu[$key]->asistido*100)/$cantidad,1);
                }
            }      
            return view ('cia.show')->with('usu',$usu)->with('cantidad',$cantidad);
        }else{
            $request->validate([
            'anio' => 'required',
            ]);
            
            $id = Hashids::decode($id)[0];

            $obj_eme = Emergencia::whereYear('fecha_emergencia',$request->anio)->get();
            $cantidad=0;
                foreach ($obj_eme as $row) {
                    foreach ($row->cias as $cia) {
                        if($cia->cia_id==$id){
                            $cantidad++;
                        }
                    }
                }
            $eme = Emergencia::whereYear('fecha_emergencia',$request->anio)->get();
            $usu = Usuario::where('cia_id',$id)->orderBy('rol','ASC')->get();
            foreach ($usu as $key => $row) {
                $usu[$key]->asistido=0;
                $usu[$key]->porcentaje=0;
                foreach ($eme as $emergencia) {
                    foreach ($emergencia->partes as $partes) {
                        if($partes->cia_id==$id){
                            foreach ($partes->asistencias as $asis) {
                               if($asis->usuario_id==$row->id){
                                    $usu[$key]->asistido++;
                               }
                            }
                        }
                    }
                }
                if($cantidad==0){
                  $usu[$key]->porcentaje=0;  
                }else{
                  $usu[$key]->porcentaje = round(($usu[$key]->asistido*100)/$cantidad,1);
                }
            }
            return view ('cia.show')->with('usu',$usu)->with('cantidad',$cantidad);
        }

    }
}
