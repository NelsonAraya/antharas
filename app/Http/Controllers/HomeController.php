<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
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
        if($estado=='S'){
            $n ='ACTIVADO';
        }else{
            $n ='DESACTIVADO';
        }
        session()->flash('info', 'Ha modificado su estado de CUARTEL a: '.$n);

        return redirect()->route('home');

    }
}
