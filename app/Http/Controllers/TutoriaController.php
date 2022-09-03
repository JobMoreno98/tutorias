<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\AlumnoInfo;
use App\InscripcionTutorias;
use App\RegistroTutorias;
use App\SinTutor;
use App\Tutor;
use App\Ciclo;
use App\Tutoria;
use App\User;
use App\TutoriaPorTutor;
use Illuminate\Http\Request;
use App\InfoTutorias;
use Auth;

class TutoriaController extends Controller
{
    public function saveSeleccionTutor($alumno_id, $tutoria_id, $ciclo)
    {
        //Leer ciclos
        $ciclos = Ciclo::orderBy('id','desc')->get();
        $ciclo_actual = Ciclo::where('activo','=',1)->first();

        if($ciclo_actual->registro_activo == '1') {
            $mensaje = " ";
            $validar = InscripcionTutorias::where([['IdUser', '=', $alumno_id],
                ['ciclo', '=', $ciclo]])->count();
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
                    $user = User::where('id','=',$alumno_id)->first();
                    $user->ciclo_actual = $ciclo;
                    $user->update();
                    $alumno = Alumno::where('IdUser','=',$alumno_id)->first();
                    $alumno->ciclo_actual = $ciclo;
                    $alumno->update();
                    $mensaje .= "Se anoto correctamente con el Tutor seleccionado";
                } else {
                    $mensaje .= "Los lugares están llenos con ese Tutor, seleccione otro";
                }
            } else {
                $mensaje = "Ya estás inscrito(a) con un Tutor(a)";
            }
        }else{
            $mensaje ="No cuenta con los permisos requeridos.";
            return redirect()->route('home')->with(array(
                'message'=>$mensaje
            ));
        }
        return redirect()->route('elegirTutoria', ['alumno_id' => $alumno_id, 'ciclo'=>$ciclo])->with(array(
            'message' => $mensaje
        ));
    }

    public function cancelarTutoria($alumno_id, $inscripcion_id, $ciclo){
        $mensaje=" ";

        $inscripcion = InscripcionTutorias::find($inscripcion_id);
        $inscripcion->delete();
        $mensaje.= 'Inscripción Eliminada';

        return redirect()->route('elegirTutoria', ['alumno_id' => $alumno_id, 'ciclo'=>$ciclo])->with(array(
            'message' => $mensaje
        ));
    }
    public function listaInscritos($ciclo){
        $listaInscritos= RegistroTutorias::where('ciclo_inscripcion', '=', $ciclo)->get()->sortBy('surname');
        //echo $listaInscritos;

        return view('tutor.listaInscritos', array(
            'listaInscritos' => $listaInscritos
        ));
    }
    public function listaInscritosDT($ciclo){
        $listaInscritos= RegistroTutorias::where('ciclo_inscripcion', '=', $ciclo)->get()->sortBy('surname');
        //echo $listaInscritos;

        return view('tutor.listaInscritosDT', array(
            'listaInscritos' => $listaInscritos,
            'ciclo'=>$ciclo
        ));
    }
    public function listaNoInscritosDT($ciclo){
        $alumnos = AlumnoInfo::all()->where('ciclo_actual','<>',$ciclo)->where('role','=','alumno');
        return view('tutor.listaNoInscritosDT', array(
            'alumnos'=>$alumnos,
            'ciclo'=>$ciclo
        ));
    }
    public function listaTutorias($ciclo){

        $listaTutorias= TutoriaPorTutor::all()->where('ciclo','=',$ciclo)->where('activo','=',1);
        //return $listaTutorias;
        return view('tutorias.listaTutorias', array(
            'listaTutorias' => $listaTutorias,
            'ciclo' => $ciclo
        ));
    }
    public function editarTutoria($tutoria_id){
        $tutoria = Tutoria::where('id', '=', $tutoria_id)->first();
        $tutores = Tutor::all();
        $tutorActual=TutoriaPorTutor::where('IdTutoria','=',$tutoria_id)->first();
        $ciclos = Ciclo::orderBy('id','desc')->get();
        $existe = 0;
        return view('tutorias.updateTutoria', array(
            'tutoria' => $tutoria,
            'tutores'=>$tutores,
            'tutorActual'=>$tutorActual,
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
    public function deleteTutoria($tutoria_id){
        $tutoria = Tutoria::where('id','=',$tutoria_id)->first();
        $tutoria->activo = 0;
        $tutoria->update();
        return redirect()->route('home')->with(array(
            "message" => "La Tutoria de se ha eliminado correctamente"
        ));
    }
}
