<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\AlumnoInfo;
use App\RegistroTutorias;
use App\User;
use App\Ciclo;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function createAlumno(){
        //Ciclos
        $ciclos = Ciclo::orderBy('id','desc')->get();

        return view('alumno.createAlumno')->with('ciclos',$ciclos);
    }

    public function saveAlumno(Request $request)
    {
        //Validar Formulario
        $validateData = $this->validate($request, [
            'IdUser'=>'required|unique:alumno',
            'codigo' => 'required',
            'semestre' => 'required',
            'cicloIngreso' => 'required',
            'edad' => 'required',
            'sexo' => 'required',
            'lugarOrigen' => 'required',
            'compartirVivienda' => 'required',
            'apoyoFamilia' => 'required',
            'empleo' => 'required',
            'internetEnCasa' => 'required',
            'computadora' => 'required',
            'computadoraAdecuada' => 'required',
            'habitosAlimenticios' => 'required',
            'deportes' => 'required',
            'enfermedad' => 'required',
            'discapacidad' => 'required',
            'acosoSexual' => 'required',
            'acosoSexualUdG' => 'required',
            'atencionPsicologica' => 'required',

        ]);

        $alumno = new Alumno();
        $alumno->IdUser = $request->input('IdUser');
        $alumno->codigo = $request->input('codigo');
        $alumno->semestre = $request->input('semestre');
        $alumno->cicloIngreso = $request->input('cicloIngreso');
        $alumno->edad = $request->input('edad');
        $alumno->sexo = $request->input('sexo');
        $alumno->lugarOrigen = $request->input('lugarOrigen');
        $alumno->compartirVivienda = $request->input('compartirVivienda');
        $alumno->apoyoFamilia = $request->input('apoyoFamilia');
        $alumno->empleo = $request->input('empleo');
        $alumno->horasTrabajo = $request->input('horasTrabajo');
        $alumno->internetEnCasa = $request->input('internetEnCasa');
        $alumno->computadora = $request->input('computadora');
        $alumno->computadoraAdecuada = $request->input('computadoraAdecuada');
        $alumno->habitosAlimenticios = $request->input('habitosAlimenticios');
        $alumno->deportes = $request->input('deportes');
        $alumno->enfermedad = $request->input('enfermedad');
        $alumno->especificarEnfermedad = $request->input('especificarEnfermedad');
        $alumno->discapacidad = $request->input('discapacidad');
        $alumno->especificarDiscapacidad = $request->input('especificarDiscapacidad');
        $alumno->acosoSexual = $request->input('acosoSexual');
        $alumno->acosoSexualUdG = $request->input('acosoSexualUdG');
        $alumno->atencionPsicologica = $request->input('atencionPsicologica');
        $alumno->save();

        return redirect()->route('home')->with(array(
            "message" => "La información se ha guardado correctamente"
        ));
    }
    public function editarAlumno($alumno_id){
        $fichaLlena=Alumno::where('IdUser','=', $alumno_id)->count();
        if($fichaLlena==1) {
            $ciclos = Ciclo::orderBy('id','desc')->get();
            $infoAlumno = Alumno::where('IdUser', '=', $alumno_id)->first();
            $existe = 0;
            return view('alumno.updateAlumno', array(
                'alumno' => $infoAlumno,
                'ciclos' => $ciclos,
                'existe' => $existe
            ));
        }else{
            return redirect()->route('home')->with(array(
                'message' => 'No se ha llenado el expediente'
            ));
        }
    }
    public function updateAlumno(Request $request, $alumno_id)
    {
        //Validar Formulario
        $validateData = $this->validate($request, [
            'codigo' => 'required',
            'semestre' => 'required',
            'cicloIngreso' => 'required',
            'edad' => 'required',
            'sexo' => 'required',
            'lugarOrigen' => 'required',
            'compartirVivienda' => 'required',
            'apoyoFamilia' => 'required',
            'empleo' => 'required',
            'internetEnCasa' => 'required',
            'computadora' => 'required',
            'computadoraAdecuada' => 'required',
            'habitosAlimenticios' => 'required',
            'deportes' => 'required',
            'enfermedad' => 'required',
            'discapacidad' => 'required',
            'acosoSexual' => 'required',
            'acosoSexualUdG' => 'required',
            'atencionPsicologica' => 'required',

        ]);
        $alumno = Alumno::where('IdUser','=',$alumno_id)->first();
        $alumno->IdUser = $request->input('IdUser');
        $alumno->codigo = $request->input('codigo');
        $alumno->semestre = $request->input('semestre');
        $alumno->cicloIngreso = $request->input('cicloIngreso');
        $alumno->edad = $request->input('edad');
        $alumno->sexo = $request->input('sexo');
        $alumno->lugarOrigen = $request->input('lugarOrigen');
        $alumno->compartirVivienda = $request->input('compartirVivienda');
        $alumno->apoyoFamilia = $request->input('apoyoFamilia');
        $alumno->empleo = $request->input('empleo');
        $alumno->horasTrabajo = $request->input('horasTrabajo');
        $alumno->internetEnCasa = $request->input('internetEnCasa');
        $alumno->computadora = $request->input('computadora');
        $alumno->computadoraAdecuada = $request->input('computadoraAdecuada');
        $alumno->habitosAlimenticios = $request->input('habitosAlimenticios');
        $alumno->deportes = $request->input('deportes');
        $alumno->enfermedad = $request->input('enfermedad');
        $alumno->especificarEnfermedad = $request->input('especificarEnfermedad');
        $alumno->discapacidad = $request->input('discapacidad');
        $alumno->especificarDiscapacidad = $request->input('especificarDiscapacidad');
        $alumno->acosoSexual = $request->input('acosoSexual');
        $alumno->acosoSexualUdG = $request->input('acosoSexualUdG');
        $alumno->atencionPsicologica = $request->input('atencionPsicologica');
        $alumno->update();

        return redirect()->route('home')->with(array(
            "message" => "La información se ha guardado correctamente"
        ));
    }
    public function fichaAlumno($alumno_id,$ciclo){
        $registro_tutor = RegistroTutorias::where('user_id', '=', $alumno_id)->get();
        $infoAlumno = AlumnoInfo::where('IdUser', '=', $alumno_id)->first();
        return view('alumno.fichaAlumno', array(
            'alumno' => $infoAlumno,
            'registro_tutor' => $registro_tutor,
            'ciclo' => $ciclo
        ));
    }
    public function actualizarEstatus($alumno_id){
        //Actualizar ciclo_actual en alumnos y en users.
        $user = User::where('id','=',$alumno_id)->first();
        $user->estatus = 'egresado';
        $user->update();
        $alumno = Alumno::where('IdUser','=',$alumno_id)->first();
        $alumno->estatus = 'egresado';
        $alumno->update();
        $registro_tutor = RegistroTutorias::where('user_id', '=', $alumno_id)->first();
        $infoAlumno = AlumnoInfo::where('IdUser', '=', $alumno_id)->first();
        return view('alumno.fichaAlumno', array(
            'alumno' => $infoAlumno,
            'registro_tutor' => $registro_tutor
        ));
    }
    public function verTutoria($alumno_id, $ciclo_actual){
        //Enviar informacion del tutor a la vista
        $tutoria = RegistroTutorias::where('user_id', '=', $alumno_id)->where('ciclo_tutoria','=',$ciclo_actual)->first();

        return view('alumno.verTutoria')->with('tutoria',$tutoria);
    }
}
