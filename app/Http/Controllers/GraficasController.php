<?php

namespace App\Http\Controllers;

use App\AlumnoInfo;
use App\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class GraficasController extends Controller
{
    public function graficas()
    {

        $alumnos = \DB::table('alumno')
            ->select(\DB::raw('count(*) as id'))
            ->first();
        $empleados = alumno::select(['empleo'])->where('empleo','=',1);
        $countEmpleados = DB::table( DB::raw("({$empleados->toSql()}) as sub") )
            ->mergeBindings($empleados->getQuery())
            ->count();
        $porempleo =number_format($countEmpleados/$alumnos->id*100,2);

        $computadoras = alumno::select(['computadora'])->where('computadora','=',1);
        $countComputadoras = DB::table( DB::raw("({$computadoras->toSql()}) as sub") )
            ->mergeBindings($computadoras->getQuery())
            ->count();
        $porcompu =number_format($countComputadoras/$alumnos->id*100,2);

        $apoyoFamilia = alumno::select(['apoyoFamilia'])->where('apoyoFamilia','=',1);
        $countApoyoFamilia = DB::table( DB::raw("({$apoyoFamilia->toSql()}) as sub") )
            ->mergeBindings($apoyoFamilia->getQuery())
            ->count();
        $porapoyoFamilia =number_format($countApoyoFamilia/$alumnos->id*100,2);

        $internetEnCasa = alumno::select(['internetEnCasa'])->where('internetEnCasa','=',1);
        $countInternetEnCasa = DB::table( DB::raw("({$internetEnCasa->toSql()}) as sub") )
            ->mergeBindings($internetEnCasa->getQuery())
            ->count();
        $porinternetEnCasa =number_format($countInternetEnCasa/$alumnos->id*100,2);

        $computadoraAdecuada = alumno::select(['computadoraAdecuada'])->where('computadoraAdecuada','=',1);
        $countComputadoraAdecuada = DB::table( DB::raw("({$computadoraAdecuada->toSql()}) as sub") )
            ->mergeBindings($computadoraAdecuada->getQuery())
            ->count();
        $porcomputadoraAdecuada =number_format($countComputadoraAdecuada/$alumnos->id*100,2);

        $habitosAlimenticios = alumno::select(['habitosAlimenticios'])->where('habitosAlimenticios','=',1);
        $countHabitosAlimenticios = DB::table( DB::raw("({$habitosAlimenticios->toSql()}) as sub") )
            ->mergeBindings($habitosAlimenticios->getQuery())
            ->count();
        $porhabitosAlimenticios =number_format($countHabitosAlimenticios/$alumnos->id*100,2);

        $deportes = alumno::select(['deportes'])->where('deportes','=',1);
        $countDeportes = DB::table( DB::raw("({$deportes->toSql()}) as sub") )
            ->mergeBindings($deportes->getQuery())
            ->count();
        $pordeportes =number_format($countDeportes/$alumnos->id*100,2);

        $enfermedad = alumno::select(['enfermedad'])->where('enfermedad','=',1);
        $countEnfermedad = DB::table( DB::raw("({$enfermedad->toSql()}) as sub") )
            ->mergeBindings($enfermedad->getQuery())
            ->count();
        $porenfermedad =number_format($countEnfermedad/$alumnos->id*100,2);

        $discapacidad = alumno::select(['discapacidad'])->where('discapacidad','=',1);
        $countDiscapacidad = DB::table( DB::raw("({$discapacidad->toSql()}) as sub") )
            ->mergeBindings($discapacidad->getQuery())
            ->count();
        $pordiscapacidad =number_format($countDiscapacidad/$alumnos->id*100,2);

        $acosoSexual = alumno::select(['acosoSexual'])->where('acosoSexual','=',1);
        $countAcosoSexual = DB::table( DB::raw("({$acosoSexual->toSql()}) as sub") )
            ->mergeBindings($acosoSexual->getQuery())
            ->count();
        $poracosoSexual =number_format($countAcosoSexual/$alumnos->id*100,2);

        $acosoSexualUdG = alumno::select(['acosoSexualUdG'])->where('acosoSexualUdG','=',1);
        $countAcosoSexualUdG = DB::table( DB::raw("({$acosoSexualUdG->toSql()}) as sub") )
            ->mergeBindings($acosoSexualUdG->getQuery())
            ->count();
        $poracosoSexualUdG =number_format($countAcosoSexualUdG/$alumnos->id*100,2);

        $atencionPsicologica = alumno::select(['atencionPsicologica'])->where('atencionPsicologica','=',1);
        $countAtencionPsicologica = DB::table( DB::raw("({$atencionPsicologica->toSql()}) as sub") )
            ->mergeBindings($atencionPsicologica->getQuery())
            ->count();
        $poratencionPsicologica =number_format($countAtencionPsicologica/$alumnos->id*100,2);

        return view('alumno.graficas')
            ->with('empleados', $empleados)->with('porempleo', $porempleo)
            ->with('comuptadoras', $computadoras)->with('porcompu', $porcompu)
            ->with('apoyoFamilia', $apoyoFamilia)->with('porapoyoFamilia', $porapoyoFamilia)
            ->with('internetEnCasa', $internetEnCasa)->with('porinternetEnCasa', $porinternetEnCasa)
            ->with('computadoraAdecuada', $computadoraAdecuada)->with('porcomputadoraAdecuada', $porcomputadoraAdecuada)
            ->with('habitosAlimenticios', $habitosAlimenticios)->with('porhabitosAlimenticios', $porhabitosAlimenticios)
            ->with('deportes', $deportes)->with('pordeportes', $pordeportes)
            ->with('enfermedad', $enfermedad)->with('porenfermedad', $porenfermedad)
            ->with('discapacidad', $discapacidad)->with('pordiscapacidad', $pordiscapacidad)
            ->with('acosoSexual', $acosoSexual)->with('poracosoSexual', $poracosoSexual)
            ->with('acosoSexualUdG', $acosoSexualUdG)->with('poracosoSexualUdG', $poracosoSexualUdG)
            ->with('atencionPsicologica', $atencionPsicologica)->with('poratencionPsicologica', $poratencionPsicologica);
    }
}
