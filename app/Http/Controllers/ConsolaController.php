<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia;
use App\Usuario;
class ConsolaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cia= Cia::get();
        $usu = Usuario::get();
        return view('consola.index')->with('cia',$cia)->with('usux',$usu);
    }
}
