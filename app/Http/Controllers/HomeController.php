<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Ciclo;
use App\RegistroTutorias;
use Illuminate\Http\Request;
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
        //Leer ciclos
        $ciclos = Ciclo::orderBy('id','desc')->get();
        $ciclo_actual = Ciclo::where('activo','=',1)->first();

        $alumno_id = Auth::user()->id;
        $fichaLlena=Alumno::where('IdUser','=', $alumno_id)->count();

        //Enviar informacion del tutor a la vista
        $registro_tutor = RegistroTutorias::where('user_id', '=', $alumno_id)->where('ciclo_tutoria','=',$ciclo_actual->nombre)->count();

        return view('home')->with(array('fichaLlena'=>$fichaLlena))->with('ciclos',$ciclos)->with('ciclo_actual',$ciclo_actual)->with('tutorias',$registro_tutor);
    }
}
