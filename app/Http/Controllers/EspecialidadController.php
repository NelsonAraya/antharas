<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;
use App\Usuario;
use Vinkla\Hashids\Facades\Hashids;
class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $esp = Especialidad::Especialidad($request->q)->orderBy('id','ASC')->paginate(10);
        return view('admin.especialidad.index')->with('esp',$esp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.especialidad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'clave' => 'required',
            'descripcion' => 'required',
        ]);

        $esp = new  Especialidad($request->all());
        $esp->clave=strtoupper($esp->clave);
        $esp->descripcion=strtolower($esp->descripcion);
        $esp->save();

        session()->flash('info', 'La Especialidad '.$esp->descripcion.' ha sido creada.');

        return redirect()->route('especialidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $id = Hashids::decode($id)[0];
        $usu = Usuario::where('cia_id','!=',11)->orderBy('rol','ASC')->get();
        $esp = Especialidad::find($id);
        $total = 0;
        $flag = false;
        foreach ($usu as $k  => $row) {
            $flag=true;
            foreach ($row->especialidades as $key) {
                if($key->id == $id){
                    $total++;
                    $flag=false;
                    break;
                }else{
                    $flag=true;
                }
            }
            if($flag){
                unset($usu[$k]);
            }
        }
        return view('admin.especialidad.show')->with('total',$total)->with('usu',$usu)->with('esp',$esp->descripcion);
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
