<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoInfo;
use App\Models\InscripcionTutorias;
use App\Models\RegistroTutorias;
use App\Models\SinTutor;
use App\Models\Tutor;
use App\Models\Ciclo;
use App\Models\Tutoria;
use App\Models\User;
use App\Models\TutoriaPorTutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutoriaController extends Controller
{
    public function saveSeleccionTutor($alumno_id, $tutoria_id, $ciclo)
    {
        //Leer ciclos
        $ciclos = Ciclo::orderBy('id', 'desc')->get();
        $ciclo_actual = Ciclo::where('activo', '=', 1)->first();

        if ($ciclo_actual->registro_activo == '1') {
            $mensaje = " ";
            $validar = InscripcionTutorias::where([
                ['IdUser', '=', $alumno_id],
                ['ciclo', '=', $ciclo]
            ])->count();
            $tutorias_por_tutor = TutoriaPorTutor::where('IdTutoria', '=', $tutoria_id)->first();
            $cupo = $tutorias_por_tutor->cupo;
            $inscritos = $tutorias_por_tutor->inscritos;
            $disponibles = $cupo - $inscritos;
            if ($validar == 0) {
                if ($disponibles > 0) {
                    $inscripcion = new InscripcionTutorias();
                    $inscripcion->IdTutoria = $tutoria_id;
                    $inscripcion->IdUser = $alumno_id;
                    $inscripcion->ciclo = $ciclo;
                    $inscripcion->save();
                    //Actualizar ciclo_actual en alumnos y en users.
                    $user = User::where('id', '=', $alumno_id)->first();
                    $user->ciclo_actual = $ciclo;
                    $user->update();
                    $alumno = Alumno::where('IdUser', '=', $alumno_id)->first();
                    $alumno->ciclo_actual = $ciclo;
                    $alumno->update();
                    $mensaje .= "Se anoto correctamente con el Tutor seleccionado";
                } else {
                    $mensaje .= "Los lugares están llenos con ese Tutor, seleccione otro";
                }
            } else {
                $mensaje = "Ya estás inscrito(a) con un Tutor(a)";
            }
        } else {
            $mensaje = "No cuenta con los permisos requeridos.";
            return redirect()->route('home')->with(array(
                'message' => $mensaje
            ));
        }
        return redirect()->route('elegirTutoria', ['alumno_id' => $alumno_id, 'ciclo' => $ciclo])->with(array(
            'message' => $mensaje
        ));
    }

    public function cancelarTutoria($alumno_id, $inscripcion_id, $ciclo)
    {
        $mensaje = " ";

        $inscripcion = InscripcionTutorias::find($inscripcion_id);
        $inscripcion->delete();
        $mensaje .= 'Inscripción Eliminada';

        return redirect()->route('elegirTutoria', ['alumno_id' => $alumno_id, 'ciclo' => $ciclo])->with(array(
            'message' => $mensaje
        ));
    }
    public function listaInscritos($ciclo)
    {
        $listaInscritos = RegistroTutorias::where('ciclo_inscripcion', '=', $ciclo)->get()->sortBy('surname');
        //echo $listaInscritos;

        return view('tutor.listaInscritos', array(
            'listaInscritos' => $listaInscritos
        ));
    }
    public function listaInscritosDT($ciclo)
    {
        $listaInscritos = RegistroTutorias::where('ciclo_inscripcion', '=', $ciclo)->get()->sortBy('surname');
        //echo $listaInscritos;

        return view('tutor.listaInscritosDT', array(
            'listaInscritos' => $listaInscritos,
            'ciclo' => $ciclo
        ));
    }
    public function listaNoInscritosDT($ciclo)
    {
        $alumnos = AlumnoInfo::all()->where('ciclo_actual', '<>', $ciclo)->where('role', '=', 'alumno');
        return view('tutor.listaNoInscritosDT', array(
            'alumnos' => $alumnos,
            'ciclo' => $ciclo
        ));
    }
    public function listaTutorias($ciclo)
    {

        $listaTutorias = TutoriaPorTutor::all()->where('ciclo', '=', $ciclo)->where('activo', '=', 1);
        //return $listaTutorias;
        return view('tutorias.listaTutorias', array(
            'listaTutorias' => $listaTutorias,
            'ciclo' => $ciclo
        ));
    }
    public function editarTutoria($tutoria_id)
    {
        $tutoria = Tutoria::where('id', '=', $tutoria_id)->first();
        $tutores = Tutor::all();
        $tutorActual = TutoriaPorTutor::where('IdTutoria', '=', $tutoria_id)->first();
        $ciclos = Ciclo::orderBy('id', 'desc')->get();
        $existe = 0;
        return view('tutorias.updateTutoria', array(
            'tutoria' => $tutoria,
            'tutores' => $tutores,
            'tutorActual' => $tutorActual,
            'ciclos' => $ciclos,
            'existe' => $existe
        ));
    }
    public function updateTutoria(Request $request, $tutoria_id)
    {
        //Validar Formulario
        $validateData = $this->validate($request, [
            'IdTutor' => 'required',
            'ciclo' => 'required',
            'nombreTutoria' => 'required',
            'cupo' => 'required',

        ]);


        $tutoria = Tutoria::where('id', '=', $tutoria_id)->first();

        $tutoria->IdTutor = $request->input('IdTutor');
        $tutoria->ciclo = $request->input('ciclo');
        $tutoria->nombre = $request->input('nombreTutoria');
        $tutoria->cupo = $request->input('cupo');

        $tutoria->save();

        return redirect()->route('home')->with(array(
            "message" => "La información se ha guardado correctamente"
        ));
    }
    public function deleteTutoria($tutoria_id)
    {
        $tutoria = Tutoria::where('id', '=', $tutoria_id)->first();
        $tutoria->activo = 0;
        $tutoria->update();
        $ciclo_actual = Ciclo::where('activo', '=', 1)->first();
        return redirect()->route('listaTutorias', $ciclo_actual->nombre);
    }

    public function repetir($ciclo_nuevo, $ciclo_viejo)
    {

        $ciclo = Ciclo::orderBy('id', 'desc')->first();
        $existe = InscripcionTutorias::where('ciclo', $ciclo_nuevo)->count();
        if ($existe > 0 && Auth::user()->role == 'admin' && $ciclo->nombre == $ciclo_nuevo) {
            abort(401);
        }


        $tutores = Tutoria::select('tutoria.IdTutor', 'tutoria.cupo')->leftjoin('tutor', 'tutoria.IdTutor', '=', 'tutor.id')
            ->where('tutoria.ciclo', $ciclo_nuevo)->orderBy('tutoria.IdTutor')->pluck('tutoria.cupo', 'tutoria.IdTutor');

        //dd($tutores);
        $alumnos = Alumno::all();

        foreach ($alumnos as $key => $value) {
            $value->semestre = $value->semestre + 2;
            $value->update();
        }

        $repetir = Tutoria::whereIn('IdTutor', $tutores->keys()->toArray())->where('ciclo', $ciclo_viejo)->get();

        foreach ($repetir as $key => $value) {
            $cupo = $tutores[$value->IdTutor];
            //echo $value->id . "<br/>";
            $alumnos = InscripcionTutorias::select('IdUser')->where('IdTutoria', $value->id)->pluck('IdUser')->take($cupo);
            if ($alumnos->count() > 0) {
                $idTutoria = Tutoria::select('id')->where('IdTutor', $value->IdTutor)->where('ciclo', $ciclo_nuevo)->value('id');
                foreach ($alumnos as $key => $value) {
                    InscripcionTutorias::firstOrCreate([
                        'IdUser' =>  $value,
                        'IdTutoria'   => $idTutoria,
                        'ciclo'      => $ciclo_nuevo,
                    ]);


                    //dd($alumno);
                }
                //dd($alumnos, ["Cupo nuevo" => $cupo], $idTutoria);
            }
        }
        return redirect()->route('home')->with(array(
            "message" => "El ciclo se ha migrado de forma exitosa."
        ));
    }
}
