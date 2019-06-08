<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Enfermedad;
use App\Ficha;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $usuario = Usuario::Nombres($request->q)->orderBy('rol','Asc')->paginate(10);
        //$usuario = Usuario::orderBy('rol','ASC')->paginate(10);
        return view('ficha.index')->with('usu',$usuario);
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
        $id = Hashids::decode($id)[0];
        $usuario = Usuario::find($id);
        $enf=Enfermedad::pluck('nombre','id');
        $edad=$this->CalculaEdad($usuario->fecha_nacimiento);
        return view('ficha.edit')->with('usu',$usuario)->with('edad',$edad)->with('enf',$enf);
    }

    private function CalculaEdad( $fecha ) {
        list($Y,$m,$d) = explode("-",$fecha);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
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
        $id2 = Hashids::decode($id)[0];
        $usu = Usuario::find($id2);
       

        if(isset($request->cronico)){
            $usu->cronico='S';
        }else{
            $usu->cronico='N';
        }
       

        
        if($usu->ficha==null){
            $ficha = new Ficha();
            $ficha->peso = $request->peso;
            $ficha->talla = $request->talla;
            $ficha->imc = $request->imc;
            $ficha->quirurgicos = $request->quiru;
            $ficha->alergias = $request->alergia;
            $ficha->tratamientos = $request->trata;
            $ficha->otras = $request->otras;
            $ficha->contacto1 = $request->contacto1;
            $ficha->fono1 = $request->fono1;
            $ficha->contacto2 = $request->contacto2;
            $ficha->fono2 = $request->fono2;
            $usu->ficha()->save($ficha);
        }else{
            $usu->ficha->peso = ($request->peso)? $request->peso: null;
            $usu->ficha->talla = ($request->talla)? $request->talla: null;
            $usu->ficha->imc = ($request->imc)? $request->imc: null;
            $usu->ficha->quirurgicos = ($request->quiru)? $request->quiru: null;
            $usu->ficha->alergias = ($request->alergia)? $request->alergia: null;
            $usu->ficha->tratamientos = ($request->trata)? $request->trata: null;
            $usu->ficha->otras = ($request->otras)? $request->otras: null;
            $usu->ficha->contacto1 = ($request->contacto1)? $request->contacto1: null; 
            $usu->ficha->fono1 = ($request->fono1)? $request->fono1: null;
            $usu->ficha->contacto2 = ($request->contacto2)? $request->contacto2: null;
            $usu->ficha->fono2 = ($request->fono2)? $request->fono2: null;
            $usu->ficha->save();
        }
        $usu->save();
        
        $usu->enfermedades()->detach();

        foreach ((array)$request->enfermedad as $row){
              $usu->enfermedades()->attach($row);
        }

        session()->flash('success', 'Se ha Modificado Ficha Clinica al Usuario : '.$usu->nombreSimple());

        return redirect()->route('ficha.index');
        
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
