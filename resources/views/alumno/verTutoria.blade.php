@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        @if (Auth::user()->id == $tutoria->user_id || Auth::user()->role == 'admin')
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title">Tutor Elegido</h5>
                            <p class="card-text">
                            <table class="table">
                                <tbody>
                                    @if (isset($tutoria->tutorNombre))
                                        <tr>
                                            <th scope="row">Nombre:</th>
                                            <td>{{ $tutoria->tutorNombre }}</td>
                                            <th scope="row">Apellido</th>
                                            <td>{{ $tutoria->apellidos }}</td>
                                            <th scope="row">Correo:</th>
                                            <td>{{ $tutoria->correo }}</td>
                                            <th scope="row">Ciclo</th>
                                            <td>{{ $tutoria->ciclo_tutoria }}</td>	
					    <td><a href="{{ route('cancelarTutoria', ['alumno_id' => $tutoria->user_id, 'inscripcion_id' => $tutoria->inscripcion_id, 'ciclo' => $tutoria->ciclo_tutoria]) }}"
                                                class="btn btn-danger btn-sm">Desincribirse</a></td>

                                        </tr>
                                    @else
                                        <tr>
                                            <th colspan="6">Sin Tutor Seleccionado</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        @endif
        <div class="row my-3">
            <div class="col-sm-12 col-md-2">
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm" style="width: 100%">
                    < Regresar</a>
            </div>
        </div>
    </div>
@endsection
