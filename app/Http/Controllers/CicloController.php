<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Ciclo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CicloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Leer ciclos
        $ciclos = Ciclo::orderBy('nombre','desc')->get();
        return view('ciclo.cicloIndex')->with('ciclos', $ciclos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('ciclo.createCiclo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar informacion
        $this->validate($request, [
            'nombre' => 'required|unique:ciclos',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'registro_activo' => 'required',
            'activo' => 'required',
        ]);

        $ciclo = Ciclo::where('activo', 1)->first();
        if (isset($ciclo->nombre)) {
            $ciclo->activo = 0;
            $ciclo->registro_activo = 0;
            $ciclo->update();
        }

        $ciclo = new Ciclo();
        $ciclo->nombre = $request->input('nombre');
        $ciclo->fecha_inicio = $request->input('fecha_inicio');
        $ciclo->fecha_fin = $request->input('fecha_fin');
        $ciclo->registro_activo = $request->input('registro_activo');
        $ciclo->leyenda = $request->input('leyenda');
        $ciclo->activo = $request->input('activo');
        $ciclo->save();

        return redirect()
            ->route('ciclos')
            ->with([
                'message' => 'La información se ha guardado correctamente',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function show(Ciclo $ciclo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function edit($ciclo_id)
    {
        //editar ciclo
        $ciclo = Ciclo::where('id', '=', $ciclo_id)->first();
        return view('ciclo.updateCiclo')->with('ciclo', $ciclo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ciclo_id)
    {
        //Validar informacion
        $validateData = $this->validate($request, [
            'nombre' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'registro_activo' => 'required',
            'activo' => 'required',
        ]);

        $ciclo_updated = Ciclo::where('id', '=', $ciclo_id)->first();
if(!$ciclo_updated){
	//echo "ciclo no encontrado";
	return redirect()->back();
}
        $ciclo_updated->nombre = $request->input('nombre');
        $ciclo_updated->fecha_inicio = $request->input('fecha_inicio');
        $ciclo_updated->fecha_fin = $request->input('fecha_fin');
        $ciclo_updated->registro_activo = $request->input('registro_activo');
        $ciclo_updated->leyenda = $request->input('leyenda');
        $ciclo_updated->activo = $request->input('activo');
        $ciclo_updated->update();

        return redirect()
            ->route('ciclos')
            ->with([
                'message' => 'La información se ha guardado correctamente',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function destroy($ciclo_id)
    {
        //dd($ciclo_id);
        Ciclo::where('id', '=', $ciclo_id)->delete();

        return redirect()
            ->route('ciclos')
            ->with([
                'message' => 'La información se ha eliminado correctamente',
            ]);
    }

    public function vista_ciclo(Request $request)
    {
        $ciclo = $request->input('ciclos');
        $alumno_id = Auth::user()->id;
        $fichaLlena = Alumno::where('IdUser', '=', $alumno_id)->count();

        return view('homeCurso')
            ->with(['fichaLlena' => $fichaLlena])
            ->with('ciclo', $ciclo);
    }
}
