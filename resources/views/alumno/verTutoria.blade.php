@extends('layouts.app')
@section('content')

    <div class="container" style="padding:20px;">
        @if (Auth::user()->id == $tutoria->user_id || Auth::user()->role == 'admin')
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tutor Elegido</h3>
                        </div>
                        <div class="panel-body">
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
        <div class="row">
            <div class="col-sm-12 col-md-2">
                <a href="{{ route('home') }}" class="btn btn-primary" style="width: 100%">
                    < Regresar</a>
            </div>
        </div>
        <h3>En caso de tener algún problema, enviar correo a la Coordinación de la Licenciatura en Relaciones
            Internacionales: coordinacion.lri.udg@gmail.com</h3>

    </div>


@endsection
