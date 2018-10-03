<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Logactivacion;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usu = Usuario::find(Auth::user()->id);
        return view('home')->with('usu',$usu);
    }

    public function myActivacion($id,$estado){

        $usu = Usuario::find($id);
        $usu->activado = $estado;
        $usu->save();
        
        $log = new  Logactivacion();

        $log->usuario_id=$id;
        $log->estado=$estado;
        $log->save();

        if($estado=='S'){
            $n ='ACTIVO';
        }else{
            $n ='INACTIVO';
        }
        session()->flash('info', 'Ha modificado su estado de CUARTEL a: '.$n);

        return redirect()->route('home');

    }

    public function reporte($id){

        $acti = Logactivacion::where('usuario_id',$id)->orderBy('id','DESC')->limit(100)->get();
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

        return view('visor.reporte')->with('acti',$paginated)->with('usu',$usu);
        
    }
}
