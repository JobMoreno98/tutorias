@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Auth::check() && $ciclo_actual->registro_activo == '1')
            <div class="row">

                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <hr>
                <h2>Selección de Tutor Ciclo {{ $ciclo }}</h2>
                <h3><strong>Alumno: </strong>{{ $alumno->name }} {{ $alumno->surname }}</h3>
                <form action="#" method="post" enctype="multipart/form-data" class="col-md-12">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="IdAlumno" name="IdAlumno"
                            value="{{ $alumno->IdUser }}">
                    </div>
                    @if ($cuentainscripcionesTutoria > 0)
                        <div class="form-group">
                            <label>
                                <H4>EL ALUMNO YA TIENE TUTOR ELEGIDO.</H4>
                            </label>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido:</th>
                                        <th scope="col">Correo:</th>
                                        <th scope="col">Ciclo</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- si ya tiene un tutor, mostrar quien es --->
                                    <tr>
                                        
                                        <td>{{ $tutorElegido->tutorNombre }}</td>
                                        <td>{{ $tutorElegido->apellidos }}</td>
                                        <td>{{ $tutorElegido->correo }}</td>
                                        <td>{{ $tutorElegido->ciclo_inscripcion }}</td>
                                        <td><a href="{{ route('cancelarTutoria', ['alumno_id' => $alumno->IdUser, 'inscripcion_id' => $tutorElegido->inscripcion_id, 'ciclo' => $ciclo]) }}"
                                                class="btn btn-danger btn-sm">Desincribirse</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="form-group">
                            <label>
                                <H4>EL ALUMNO NO HA ELEGIDO TUTOR.</H4>
                            </label>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">

                                <thead>
                                    <tr>
                                        <th scope="col">IdTutor</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Semblanza</th>
                                        <th scope="col">Ciclo</th>
                                        <th scope="col">Nombre Tutoria</th>
                                        @if (Auth::user()->role == 'admin')
                                            <th scope="col">Cupo</th>
                                            <th scope="col">Inscritos</th>
                                            <th scope="col">Disponibles</th>
                                        @endif
                                        <th scope="col">Seleccionar Tutor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tutorias_por_tutor as $tutoria_por_tutor)
                                        <tr>
                                            <th scope="row">{{ $tutoria_por_tutor->IdTutor }}</th>
                                            <th scope="row">{{ $tutoria_por_tutor->tutorNombre }}</th>
                                            <th scope="row">{{ $tutoria_por_tutor->apellidos }}</th>
                                            <td>{{ $tutoria_por_tutor->correo }}</td>
                                            <td>
                                                <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                                <a href="#semblanza{{ $tutoria_por_tutor->IdTutor }}" role="button"
                                                    class="btn btn-success btn-sm" data-toggle="modal">Semblanza</a>

                                                <!-- Modal / Ventana / Overlay en HTML -->
                                                <div id="semblanza{{ $tutoria_por_tutor->IdTutor }}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-hidden="true">
                                                                    <h4>Cerrar</h4>
                                                                </button>

                                                            </div>
                                                            <div class="modal-body">
                                                                <h3>{{ $tutoria_por_tutor->tutorNombre }}
                                                                    {{ $tutoria_por_tutor->apellidos }}</h3>
                                                                <h3 class="text-info">
                                                                    <small>{{ $tutoria_por_tutor->semblanza }}</small>
                                                                </h3>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Cerrar</button>
                                                                {{-- {{ route('delete-alumno',['alumno_id' => $listaTutor->id]) }} --}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $tutoria_por_tutor->ciclo }}</td>
                                            <td>{{ $tutoria_por_tutor->tutoriaNombre }}</td>
                                            @if (Auth::user()->role == 'admin')
                                                <td align="center">{{ $tutoria_por_tutor->cupo }}</td>
                                                <td align="center">{{ $tutoria_por_tutor->inscritos }}</td>
                                            @endif
                                            @if (Auth::user()->role == 'admin')
                                                <td align="center">
                                                    {{ $disponible = $tutoria_por_tutor->cupo - $tutoria_por_tutor->inscritos }}
                                                </td>
                                            @endif
                                            @if ($tutoria_por_tutor->cupo - $tutoria_por_tutor->inscritos > 0)
                                                <td><a href="{{ route('saveSeleccionTutor', ['alumno_id' => $alumno->IdUser, 'tutoria_id' => $tutoria_por_tutor->IdTutoria, 'ciclo' => $tutoria_por_tutor->ciclo]) }}"
                                                        class="btn btn-primary btn-sm"> Elegir a este tutor </a></td>
                                            @else
                                                <td align="center">Sin cupo</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <p>
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('listaInscritosDT', ['ciclo' => $ciclo]) }}" class="btn btn-primary">
                                < Regresar</a>
                                @else
                                    <a href="{{ route('home') }}" class="btn btn-primary">
                                        < Regresar</a>
                        @endif
                    </p>




                </form>
                <br>

            </div>
        @else
            <h2>El periodo de inscripciones ha terminado <br> <b>{{ $ciclo_actual->leyenda }}</b> </h2>
            <hr>
        @endif
    </div>
@endsection
