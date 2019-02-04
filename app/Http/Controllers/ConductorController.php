<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Vehiculo;
use App\Activacion;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Vinkla\Hashids\Facades\Hashids;
class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuario = Usuario::Nombres($request->q)->where('conductor','S')->orderBy('rol','Asc')->paginate(10);
        //$usuario = Usuario::where('conductor','S')->orderBy('rol','ASC')->paginate(10);
        return view('rrhh.conductores.index')->with('usu',$usuario);
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
        $mat = Vehiculo::where('estado','A')->get();
        return view('rrhh.conductores.edit')
                ->with('usu',$usuario)
                ->with('mat',$mat);
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
        $id = Hashids::decode($id)[0];
        $usu = Usuario::find($id);

        $usu->vehiculos()->detach();

        foreach ((array)$request->vehiculos as $row){
              $usu->vehiculos()->attach($row);
        }

        session()->flash('success', 'Ha sido Modificado '.$usu->nombreSimple().'');

        return redirect()->route('conductores.index');
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
    public function reporte($id){

        $id = Hashids::decode($id)[0];
        $acti = Activacion::where('usuario_id',$id)->orderBy('id','DESC')->limit(100)->get();
        $usu = Usuario::find($id);
        $perPage =10;
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
        if ($currentPage == 1) {
            $start = 0;
        }
        else {
            $start = ($currentPage - 1) * $perPage;
        }

        $currentPageCollection = $acti->slice($start, $perPage)->all();

        $paginated = new LengthAwarePaginator($currentPageCollection, count($acti), $perPage);

        $paginated->setPath(LengthAwarePaginator::resolveCurrentPath());

        return view('rrhh.conductores.reporte')->with('acti',$paginated)->with('usu',$usu);
        
    }
}
