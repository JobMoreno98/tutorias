@extends('layouts.app')

@section('content')
    {{-- <div class="container">
        <div class="row">
            @if (Auth::check())
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Tablero</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}

                                </div>
                            @endif
                            <br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="4" scope="col">Menú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Auth::user()->role != 'admin')
                                        <tr>
                                            <th scope="row"><br>Registro</th>
                                            <td><br>Le permite ver sus datos personales registrados y sus materias inscritas
                                            </td>
                                            <td>
                                                @if ($fichaLlena == 0)
                                                    <br><a href="{{ route('createAlumno') }}"
                                                        class="btn btn-primary">Capturar Registro</a>
                                                @else
                                                    <br><a
                                                        href="{{ route('editarAlumno', ['alumno_id' => Auth::user()->id]) }}"
                                                        class="btn btn-success">Editar Registro</a>
                                                @endif
                                                @if ($tutorias > 0)
                                                    <a href="{{ route('ver-tutoria', ['alumno_id' => Auth::user()->id, 'ciclo_actual' => $ciclo_actual->nombre]) }}"
                                                        class="btn btn-primary">Ver tutor</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><br>Inscribirse con tutor</th>
                                            <td><br>Permite inscribirse con un Tutor en este ciclo</td>

                                            @if ($ciclo_actual->registro_activo == '1')
                                                <td colspan="2"><br><a class="btn btn-primary"
                                                        href="{{ route('elegirTutoria', ['alumno_id' => Auth::user()->id, 'ciclo' => $ciclo_actual->nombre]) }}">Seleccionar
                                                        Tutor</a></td>
                                            @else
                                                <td><br>{{ $ciclo_actual->leyenda }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                    @if (Auth::user()->role == 'admin')
                                        <tr>
                                            <td>
                                                <form action="{{ route('vista-ciclo') }}" method="post"
                                                    enctype="multipart/form-data" class="form-inline">
                                                    <div class="form-group mb-2">
                                                        {!! csrf_field() !!}
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    Debe de llenar los campos marcados con un asterisco (*)
                                                                    o el formulario y su información ya se registró.
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form-group mx-sm-6 mb-2">
                                                        <label for="ciclos">Seleccione un ciclo</label>
                                                        <select class="form-control" id="ciclos" name="ciclos">
                                                            @foreach ($ciclos as $ciclo)
                                                                @if ($ciclo_actual->nombre == $ciclo->nombre)
                                                                    <option value="{{ $ciclo_actual->nombre }}" selected>
                                                                        {{ $ciclo_actual->nombre }}</option>
                                                                @else
                                                                    <option value="{{ $ciclo->nombre }}">
                                                                        {{ $ciclo->nombre }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="submit" class="btn btn-primary" value="Ver ciclo">
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><br>Administración <br></th>
                                        </tr>
                                        <tr>
                                            <td align="center"><br><a class="btn btn-primary"
                                                    href="{{ route('listaTutores') }}">Listado de Tutores</a></td>
                                            <td align="center"><br><a class="btn btn-success"
                                                    href="{{ route('createTutor') }}">Capturar Tutores</a></td>
                                            <td align="center"><br><a class="btn btn-success"
                                                    href="{{ route('createTutoria') }}">Capturar Tutorías</a></td>
                                            <td align="center"><br><a class="btn btn-primary"
                                                    href="{{ route('ciclos') }}">Listado de ciclos</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="3"><br>Estadísticas <br></th>
                                        </tr>
                                        <tr>

                                            <td align="center"><br><a class="btn btn-success"
                                                    href="{{ route('graficas') }}">Estadísticas</a></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div> --}}
    <div class="container" style="background: #fff;padding:20px;">
        <div class="row">
            @if (Auth::user()->role != 'admin')
                <div class="col-sm-12 ">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h5>Registro</h5>
                            <hr>
                            <p>Le permite ver sus datos personales registrados y sus materias inscritas</p>
        
                            @if ($fichaLlena == 0)
                                <a href="{{ route('createAlumno') }}" class="btn btn-primary">Capturar Registro</a>
                            @else
                                <a href="{{ route('editarAlumno', ['alumno_id' => Auth::user()->id]) }}"
                                    class="btn btn-success">Editar Registro</a>
                            @endif
                            @if ($tutorias > 0)
                                <a href="{{ route('ver-tutoria', ['alumno_id' => Auth::user()->id, 'ciclo_actual' => $ciclo_actual->nombre]) }}"
                                    class="btn btn-primary">Ver tutor</a>
                            @endif
                        </div>
                      </div>
                      <div class="panel panel-default">
                        <div class="panel-body">
                            <h5>Inscribirse con tutor</h5>
                            <hr>
                            <p>Permite inscribirse con un Tutor en este ciclo</p> 
        
                            @if ($ciclo_actual->registro_activo == '1' && $tutorias == 0)
                                <a class="btn btn-primary" href="{{ route('elegirTutoria', ['alumno_id' => Auth::user()->id, 'ciclo' => $ciclo_actual->nombre]) }}">Seleccionar Tutor</a>
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
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="{{ route('vista-ciclo') }}" method="post" enctype="multipart/form-data"
                            class="form-inline">
                            <div class="form-group mb-2">
                                {!! csrf_field() !!}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            Debe de llenar los campos marcados con un asterisco (*) o el formulario y su
                                            información ya se registró.
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mx-sm-6 mb-2">
                                <label for="ciclos" class="form-label">
                                    <h3> Seleccione un ciclo</h3>
                                </label>
                                <select class="form-control" id="ciclos" name="ciclos">
                                    @foreach ($ciclos as $ciclo)
                                        @if ($ciclo_actual->nombre == $ciclo->nombre)
                                            <option value="{{ $ciclo_actual->nombre }}" selected>
                                                {{ $ciclo_actual->nombre }}</option>
                                        @else
                                            <option value="{{ $ciclo->nombre }}">{{ $ciclo->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-primary" value="Ver ciclo">
                            </div>
                            
                        </form>
                        </div>
                      </div>

                </div>
                <div class="col-sm-12 border">
                    <div class="panel panel-default">
                        <div class="panel-body">
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
                    <div class="panel panel-default">
                        <div class="panel-body">
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
