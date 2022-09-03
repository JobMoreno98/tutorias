@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Auth::check())
            <div class="row">

                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <hr>
                <h2>Lista de Alumnos Inscritos con Tutor</h2>



                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">IdAlumno</th>
                                    <th scope="col">Apellido:</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Ciclo</th>
                                    <th scope="col">Nombre Tutor</th>
                                    <th scope="col">Apellido Tutor</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- si ya tiene un tutor, mostrar quien es --->
                                @foreach($listaInscritos as $listaInscrito)
                                    <tr>
                                        <td>{{$listaInscrito->user_id}}</td>
                                        <td>{{$listaInscrito->surname}}</td>
                                        <td>{{$listaInscrito->name}}</td>

                                        <td>{{$listaInscrito->ciclo_inscripcion}}</td>
                                        <td>{{$listaInscrito->tutorNombre}}</td>
                                        <td>{{$listaInscrito->apellidos}}</td>
                                        <td><a href="{{ route('fichaAlumno', ['alumno_id' => $listaInscrito->user_id]) }}" class="btn btn-success">Ver Expediente</a></td>
                                        <td><a href="{{ route('cancelarTutoria', ['alumno_id' => Auth::user()->id, 'inscripcion_id' => $listaInscrito->inscripcion_id]) }}" class="btn btn-danger">Desincribirse</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>





                <br>
                <p>En caso de tener alguna duda contactar a su coordinador de carrera</p>
            </div>
            <div class="row">
                <br>
                <hr>
                <p>CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y HUMANIDADES.</p>

                <p>Guanajuato 1047 Guadalajara (México)
                    Tel.: 33 3819 3300 Ext 23653</p>
            </div>
        @endif
    </div>
@endsection
