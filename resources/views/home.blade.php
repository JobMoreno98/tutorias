@extends('layouts.app')

@section('content')
    @php
        date_default_timezone_set('America/Mexico_City');
        $inicio = '27-02-2023 14:00:00';
        $date = date('d-m-Y H:i:s');
    @endphp

    <div class="container" style="background: #fff;padding:20px;">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
                </div>
            @endif
            @if (Auth::user()->role != 'admin')
                <div class="col-sm-12 ">
                    <div class="card">
                        <div class="card-body d-flex flex-row flex-wrap align-items-center">
                            {{-- 
                            <div class="col-sm-12 col-md-6">


                                <p>Le permite ver sus datos personales registrados y sus materias inscritas</p>
                                @if ($fichaLlena == 0)
                                    <p>Antes de registrar algun tutor favor de registrar tus datos en el boton de azúl</p>
                                @endif
                                @if ($fichaLlena == 0)
                                    <a href="{{ route('createAlumno') }}" class="btn btn-primary">Capturar Registro</a>
                                @else
                                    <a href="{{ route('editarAlumno', ['alumno_id' => Auth::user()->id]) }}"
                                        class="btn btn-sm m-1 btn-success">Editar mi registro</a>
                                @endif
                            </div>
 --}}
                            <div class="col-sm-12 border-bottom mb-1 pb-1">
                                <h5>Registro</h5>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <form action="{{ route('registro.evidencia') }}" method="POST" class="p-2"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <!-- Campo de archivo -->
                                    <div class="mb-3">
                                        <label for="imagen" class="form-label">Selecciona una imagen</label>
                                        <input class="form-control" type="file" id="imagen" name="imagen"
                                            accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-upload"></i> Subir
                                    </button>
                                </form>
                            </div>
                            <div class="ccol-sm-12 col-md-6">

                                @if ($tutorias > 0)
                                    <a href="{{ route('ver-tutoria', ['alumno_id' => Auth::user()->id, 'ciclo_actual' => $ciclo_actual->nombre]) }}"
                                        class="btn btn-sm m-1 btn-primary">Ver tutor</a>
                                @endif
                                <a class="btn btn-sm m-1 btn-primary" href="https://forms.gle/Rm1BnFxwns6XuKbJ8">Favor de
                                    contestar la siguiente encuesta</a>
                            </div>

                        </div>
                    </div>
                    <div class="card my-2">
                        <div class="card-body">
                            <h5>Inscribirse con tutor</h5>
                            <hr>
                            <p>Permite inscribirse con un Tutor en este ciclo</p>

                            @if ($ciclo_actual->registro_activo == '1' && $tutorias == 0 && $fichaLlena == 1)
                                <a class="btn btn-primary btn-sm m-1"
                                    href="{{ route('elegirTutoria', ['alumno_id' => Auth::user()->id, 'ciclo' => $ciclo_actual->nombre]) }}">Seleccionar
                                    Tutor</a>
                            @elseif ($tutorias != 0)
                                <p>Ya haz registrado un Tutor</p>
                            @else
                                {{ $ciclo_actual->leyenda }}
                            @endif

                        </div>
                    </div>
                </div>
            @endif

        </div>


        @if (Auth::user()->role == 'admin')
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('vista-ciclo') }}" method="post" enctype="multipart/form-data"
                                class="d-flex  align-self-center">
                                <div class="form-group mb-2">
                                    {!! csrf_field() !!}
                                </div>
                                <div class="d-flex">
                                    <div class="mx-2">
                                        <label for="ciclos" class="form-label">
                                            <h3> Seleccione un ciclo</h3>
                                        </label>
                                    </div>
                                    <div>
                                        <select class="form-control" id="ciclos" class="px-3" name="ciclos">
                                            @foreach ($ciclos as $ciclo)
                                                @if ($ciclo_actual->nombre == $ciclo->nombre)
                                                    <option value="{{ $ciclo_actual->nombre }}" selected>
                                                        {{ $ciclo_actual->nombre }}</option>
                                                @else
                                                    <option value="{{ $ciclo->nombre }}">{{ $ciclo->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <div class="mx-2">
                                    <input type="submit" class="btn btn-primary" value="Ver ciclo">
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-sm-12 my-3">
                    <div class="card">
                        <div class="card-body">
                            <h4>Administración</h4>
                            <hr>
                            <a class="btn btn-primary" href="{{ route('listaTutores') }}">Listado de Tutores</a>
                            <a class="btn btn-success" href="{{ route('createTutor') }}">Capturar
                                Tutores</a>
                            <a class="btn btn-success" href="{{ route('createTutoria') }}">Capturar
                                Tutorías</a>
                            <a class="btn btn-primary" href="{{ route('ciclos') }}">Listado de
                                ciclos</a>
                        </div>
                    </div>
                </div>



                <hr>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Estadísticas</h4>
                            <hr>
                            <a class="btn btn-success" href="{{ route('graficas') }}">Estadísticas</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
