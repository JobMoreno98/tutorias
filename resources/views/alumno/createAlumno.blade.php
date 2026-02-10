@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
                <h2>Registro para Tutorias</h2>
                <hr>
                <p>* Campos Obligatorios</p>
            </div>
            <form action="{{ route('saveAlumno') }}" method="post" 
            
            enctype="multipart/form-data" class="col-md-12 d-flex flex-wrap justify-content-start align-items-center"
            
            >
                <div class="row">
                    <div class="col-12">
                        {!! csrf_field() !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    Debe de llenar los campos marcados con un asterisco (*) o el formulario y su información
                                    ya se registró.
                                </ul>
                            </div>
                        @endif

                        <div class="form-group p-1 col-md-4 col-xs-12{{ $errors->has('codigo') ? ' has-error' : '' }}">
                            <label for="codigo">Código de estudiante*</label>
                            <input type="hidden" class="form-control" id="IdUser" name="IdUser"
                                value="{{ Auth::user()->id }}" readonly>
                            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}">
                        </div>

                        <div class="form-group p-1 col-md-4 col-xs-12">
                            <label for="edad">Edad *</label>
                            <input type="number" class="form-control" id="edad" name="edad" value="{{ old('edad') }}">
                        </div>
                        <div class="form-group p-1 col-md-4 col-xs-12">
                            <label for="sexo">Sexo*</label>
                            <select class="form-control" id="sexo" name="sexo">
                                <option disabled selected>Elegir</option>
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                                <option value="No especificado">No especificado</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="semestre">Semestre*</label>
                            <select class="form-control" id="semestre" name="semestre">
                                <option disabled selected>Elegir</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="cicloIngreso">Ciclo de Ingreso*</label>
                            <select class="form-control" id="cicloIngreso" name="cicloIngreso">
                                @foreach ($ciclos as $ciclo)
                                    <option value="{{ $ciclo->nombre }}">{{ $ciclo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group p-1 col-xs-12">
                            <label for="name"><strong>CUESTIONARIO DE INFORMACIÓN PARA ATENCIÓN TUTORIAL</strong></label>
                            <label for="name">La información registrada tendrá tratamiento confidencial y se utilizará para
                                fines estadísticos.</label>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="lugarOrigen">1. Lugar de Origen *</label>
                            <input type="text" class="form-control" id="lugarOrigen" name="lugarOrigen"
                                value="{{ old('lugarOrigen') }}">
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="compartirVivienda">2. ¿Con quién compartes tu vivienda? *</label>
                            <input type="text" class="form-control" id="compartirVivienda" name="compartirVivienda"
                                value="{{ old('compartirVivienda') }}">
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="apoyoFamilia">3.¿Tu familia te apoya económicamente para realizar tus
                                estudios?*</label>
                            <select class="form-control" id="apoyoFamilia" name="apoyoFamilia">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="habitosAlimenticios">4. ¿Consideras que tienes hábitos alimenticios
                                adecuados?*</label>
                            <select class="form-control" id="habitosAlimenticios" name="habitosAlimenticios">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="empleo">5. ¿Cuentas con algún empleo actualmente?*</label>
                            <select class="form-control" id="empleo" name="empleo">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="horasTrabajo">De ser así, ¿cuántas horas trabajas a la semana? *</label>
                            <select class="form-control" id="horasTrabajo" name="horasTrabajo">
                                <option value="No Aplica" selected>No Aplica</option>
                                <option disabled>Elegir</option>
                                <option value="0-5">0-5</option>
                                <option value="6-10">6-10</option>
                                <option value="11-15">11-15</option>
                                <option value="15-20">15-20</option>
                                <option value="21-30">21-30</option>
                                <option value="31-40">31-40</option>
                                <option value=">40">>40</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="internetEnCasa">6. ¿Cuentas con internet en casa?*</label>
                            <select class="form-control" id="internetEnCasa" name="internetEnCasa">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="computadora">7. ¿Cuentas con equipo de cómputo personal?*</label>
                            <select class="form-control" id="computadora" name="computadora">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="computadoraAdecuada">8. ¿Tienes acceso a equipo de cómputo adecuado?*</label>
                            <select class="form-control" id="computadoraAdecuada" name="computadoraAdecuada">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="deportes">9. ¿Practicas algún deporte de forma rutinaria?*</label>
                            <select class="form-control" id="deportes" name="deportes">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="enfermedad">10. ¿Tienes alguna enfermedad crónico-degenerativa?*</label>
                            <select class="form-control" id="enfermedad" name="enfermedad">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="especificarEnfermedad">De ser así, señalar cuál o cuál es</label>
                            <input type="text" class="form-control" id="especificarEnfermedad"
                                name="especificarEnfermedad" value="{{ old('especificarEnfermedad') }}">
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="discapacidad">11. ¿Tienes alguna discapacidad?*</label>
                            <select class="form-control" id="discapacidad" name="discapacidad">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-6 col-xs-12">
                            <label for="especificarDiscapacidad">De ser así, señalar cuál o cuál es</label>
                            <input type="text" class="form-control" id="especificarDiscapacidad"
                                name="especificarDiscapacidad" value="{{ old('especificarDiscapacidad') }}">
                        </div>
{{--
                        <div class="form-group p-1 col-md-12 col-xs-12">
                            <label for="acosoSexual">12. ¿Has sufrido violencia o acoso sexual?*</label>
                            <select class="form-control" id="acosoSexual" name="acosoSexual">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-12 col-xs-12">
                            <label for="acosoSexualUdG">13. ¿Has sufrido violencia o acoso sexual por parte de algún
                                integrante de la comunidad universitaria?*</label>
                            <select class="form-control" id="acosoSexualUdG" name="acosoSexualUdG">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group p-1 col-md-12 col-xs-12">
                            <label for="atencionPsicologica">14. ¿Consideras que requieres atención psicológica? *</label>
                            <select class="form-control" id="atencionPsicologica" name="atencionPsicologica">
                                <option disabled selected>Elegir</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{ route('home') }}" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar datos</button>
                    </div>
                </div>
            </form>
    </div>
@else
    El periodo de inscripciones se ha terminado
    @endif

@endsection
