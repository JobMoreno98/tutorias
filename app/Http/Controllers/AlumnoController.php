<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoInfo;
use App\Models\RegistroTutorias;
use App\Models\User;
use App\Models\Ciclo;
use App\Models\EvidenciaForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class AlumnoController extends Controller
{
    public function createAlumno()
    {
        //Ciclos
        $ciclos = Ciclo::orderBy('nombre', 'desc')->get();

        return view('alumno.createAlumno')->with('ciclos', $ciclos);
    }

    public function saveAlumno(Request $request)
    {
        //Validar Formulario
        $validateData = $this->validate($request, [
            'IdUser' => 'required|unique:alumno',
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
        $alumno->acosoSexual = 0;
        $alumno->acosoSexualUdG = 0;
        $alumno->atencionPsicologica = 0;
        $alumno->save();

        return redirect()->route('home')->with(array(
            "message" => "La información se ha guardado correctamente"
        ));
    }
    public function editarAlumno($alumno_id)
    {
        $fichaLlena = Alumno::where('IdUser', '=', $alumno_id)->count();
        if ($fichaLlena == 1) {
            $ciclos = Ciclo::orderBy('nombre', 'desc')->get();
            $infoAlumno = Alumno::where('IdUser', '=', $alumno_id)->first();
            $existe = 0;
            return view('alumno.updateAlumno', array(
                'alumno' => $infoAlumno,
                'ciclos' => $ciclos,
                'existe' => $existe
            ));
        } else {
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
        ]);
        $alumno = Alumno::where('IdUser', '=', $alumno_id)->first();
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
        $alumno->acosoSexual = 0;
        $alumno->acosoSexualUdG = 0;
        $alumno->atencionPsicologica = 0;
        $alumno->update();

        return redirect()->route('home')->with(array(
            "message" => "La información se ha guardado correctamente"
        ));
    }
    public function fichaAlumno($alumno_id, $ciclo)
    {
        $registro_tutor = RegistroTutorias::where('user_id', '=', $alumno_id)->get();
        $infoAlumno = AlumnoInfo::where('IdUser', '=', $alumno_id)->first();
        return view('alumno.fichaAlumno', array(
            'alumno' => $infoAlumno,
            'registro_tutor' => $registro_tutor,
            'ciclo' => $ciclo
        ));
    }
    public function actualizarEstatus($alumno_id)
    {
        //Actualizar ciclo_actual en alumnos y en users.
        $user = User::where('id', '=', $alumno_id)->first();
        $user->estatus = 'egresado';
        $user->update();
        $alumno = Alumno::where('IdUser', '=', $alumno_id)->first();
        $alumno->estatus = 'egresado';
        $alumno->update();
        $registro_tutor = RegistroTutorias::where('user_id', '=', $alumno_id)->first();
        $infoAlumno = AlumnoInfo::where('IdUser', '=', $alumno_id)->first();
        return view('alumno.fichaAlumno', array(
            'alumno' => $infoAlumno,
            'registro_tutor' => $registro_tutor
        ));
    }
    public function verTutoria($alumno_id, $ciclo_actual)
    {
        //Enviar informacion del tutor a la vista
        $tutoria = RegistroTutorias::where('user_id', '=', $alumno_id)->where('ciclo_tutoria', '=', $ciclo_actual)->first();

        return view('alumno.verTutoria')->with('tutoria', $tutoria);
    }

    public function evidenciaForm(Request $request)
    {
        $messages = [
            'required' => "El campo :attribute es obligatorio",
        ];
        $request->validate([
            'imagen' => ['required', File::types(['jpg', 'jpeg'])->min(100)->max(5120)]
        ], $messages);

        $archivo = $request->file('imagen');
        $nombre =  Auth::user()->name . '.jpg';
        $nombre = str_replace('/', '-', $nombre);

        Storage::disk('images')->put($nombre, \File::get($archivo));

        EvidenciaForm::create([
            'user_id' => Auth::user()->id,
            'file' => $nombre
        ]);

        return redirect()
            ->route('home')
            ->with([
                'message' => 'Se ha enviado exitosamente el formulario',
            ]);
    }
}
