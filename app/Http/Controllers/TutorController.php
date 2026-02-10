<?php

namespace App\Http\Controllers;

use App\Models\AlumnoInfo;
use App\Models\InscripcionTutorias;
use App\Models\RegistroTutorias;
use App\Models\SinTutor;
use App\Models\Ciclo;
use App\Models\TutoriaPorTutor;
use Illuminate\Http\Request;
use App\Models\Tutor;
use App\Models\Tutoria;
use App\Models\Alumno;
use App\Models\InfoTutorias;
class TutorController extends Controller
{
    public function createTutor()
    {
        return view('tutor.createTutor');
    }
    public function saveTutor(Request $request)
    {
        //Validar Formulario
        $validateData = $this->validate($request, [
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required',
            'semblanza' => 'required',
        ]);

        $tutor = new Tutor();
        $tutor->nombre = $request->input('nombre');
        $tutor->apellidos = $request->input('apellidos');
        $tutor->correo = $request->input('email');
        $tutor->semblanza = $request->input('semblanza');
        $tutor->save();

        return redirect()
            ->route('home')
            ->with([
                'message' => 'La información se ha guardado correctamente',
            ]);
    }
    public function editarTutor($tutor_id)
    {
        $infoTutor = Tutor::where('id', '=', $tutor_id)->first();
        return view('tutor.updateTutor', [
            'tutor' => $infoTutor,
        ]);
    }
    public function updateTutor(Request $request, $tutor_id)
    {
        //Validar Formulario
        $validateData = $this->validate($request, [
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required',
            'semblanza' => 'required',
        ]);
        //Actualizar
        $tutor = Tutor::where('id', '=', $tutor_id)->first();
        $tutor->nombre = $request->input('nombre');
        $tutor->apellidos = $request->input('apellidos');
        $tutor->correo = $request->input('email');
        $tutor->semblanza = $request->input('semblanza');
        $tutor->update();
        return redirect()
            ->route('listaTutores')
            ->with([
                'message' => 'El tutor se ha actualizado correctamente',
            ]);
    }
    public function deleteTutor($tutor_id)
    {
        $tutor = Tutor::where('id', '=', $tutor_id)->first();
        $tutor->activo = 0;
        $tutor->update();
        return redirect()
            ->route('home')
            ->with([
                'message' => 'El tutor se ha eliminado correctamente',
            ]);
    }
    public function createTutoria()
    {
        $tutor = Tutor::orderBy('nombre')->get();
        //Ciclos
        $ciclos = Ciclo::where('activo', 1)->first();

        return view('tutorias.createTutoria', [
            'tutores' => $tutor,
            'ciclos' => $ciclos,
        ]);
    }
    public function saveTutoria(Request $request)
    {
        //Validar Formulario
        $this->validate($request, [
            'IdTutor' => 'required',
            'ciclo' => 'required',
            'nombreTutoria' => 'required',
            'cupo' => 'required',
        ]);

        $tutoria = new Tutoria();
        $tutoria->IdTutor = $request->input('IdTutor');
        $tutoria->ciclo = $request->input('ciclo');
        $tutoria->nombre = $request->input('nombreTutoria');
        $tutoria->cupo = $request->input('cupo');
        $tutoria->save();

        return redirect()
            ->route('home')
            ->with([
                'message' => 'La información se ha guardado correctamente',
            ]);
    }
    public function obtenerTutorias($alumno_id, $ciclo)
    {
        //Agregar cupo
        //return $alumno_id;
        $cuentainscripcionesTutoria = InscripcionTutorias::where('IdUser', '=', $alumno_id)
            ->where('ciclo', '=', $ciclo)
            ->count();
        //return $cuentainscripcionesTutoria;
        $fichaLlena = Alumno::where('IdUser', '=', $alumno_id)->count();
        if ($fichaLlena == 1) {
            $alumno = AlumnoInfo::where('IdUser', '=', $alumno_id)->first();
            //traerse el que ya tiene elegido si aplica
            $tutorElegido = RegistroTutorias::where('user_id', '=', $alumno_id)
                ->where('ciclo_inscripcion', '=', $ciclo)
                ->first();

            $tutorias_por_tutor = TutoriaPorTutor::all()
                ->where('ciclo', '=', $ciclo)
                ->where('activo', 1);

            //Leer ciclos
            $ciclos = Ciclo::orderBy('id', 'desc')->get();
            $ciclo_actual = Ciclo::where('activo', '=', 1)->first();

            return view('alumno.elegirTutor', [
                'alumno' => $alumno,
                'cuentainscripcionesTutoria' => $cuentainscripcionesTutoria,
                'tutorias_por_tutor' => $tutorias_por_tutor,
                'tutorElegido' => $tutorElegido,
                'ciclo' => $ciclo,
                'ciclo_actual' => $ciclo_actual,
            ]);
        } else {
            return redirect()
                ->route('home')
                ->with([
                    'message' => 'El alumno no ha llenado su ficha básica. Favor de Capturar Registro. Primero se tiene que llenar antes de elegir tutor.',
                ]);
        }
    }
    public function listaTutores()
    {
        $listaTutores = Tutor::all()
            ->where('activo', '=', 1)
            ->sortBy('apellidos');
        return view('tutor.listaTutores', [
            'listaTutores' => $listaTutores,
        ]);
    }
}
