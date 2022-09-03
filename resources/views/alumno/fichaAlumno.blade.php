@extends('layouts.app')
@section('content')

    <div class="container">
        @if(Auth::user()->IdAlumno == $alumno->IdUser || Auth::user()->role == 'admin')
            <div class="row">
                <p>
                    @if(Auth::user()->role == 'admin')
                        <a href="{{ route('listaInscritosDT',$ciclo) }}" class="btn btn-primary">Ver alumnos con tutor {{$ciclo}}</a>
                        <a href="{{ route('listaNoInscritosDT',$ciclo) }}" class="btn btn-primary">Ver alumnos sin tutor {{$ciclo}}</a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
                    @endif
                </p>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ficha Individual del Alumno</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th colspan="6" scope="col">{{$alumno->IdUser }} - {{ $alumno->surname }} {{ $alumno->name }} </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Código de estudiante</th>
                                <td>{{ $alumno->codigo }}</td>
                                <th scope="row">Semestre</th>
                                <td>{{ $alumno->semestre }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Estatus</th>
                                <td>{{ $alumno->estatus }}</td>
                                <th scope="row">Ciclo de Ingreso</th>
                                <td>{{ $alumno->cicloIngreso }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Último ciclo de registro</th>
                                <td>{{ $alumno->ciclo_actual }}</td>
                                <th scope="row">Email</th>
                                <td>{{ $alumno->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Edad</th>
                                <td>{{ $alumno->edad }}</td>
                                <th scope="row">Sexo</th>
                                <td>{{ $alumno->sexo }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Lugar de Origen</th>
                                <td>{{ $alumno->lugarOrigen }}</td>
                                <th scope="row">Vivienda Compartida</th>
                                <td>{{ $alumno->compartirVivienda }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Apoyo Familiar</th>
                                <td>@if($alumno->apoyoFamilia==1) Si @else No @endif</td>
                                <th scope="row">Empleo</th>
                                <td>@if($alumno->empleo==1) Si @else No @endif Horas de Trabajo: {{ $alumno->horasTrabajo }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Internet en Casa</th>
                                <td>@if($alumno->internetEnCasa==1) Si @else No @endif</td>
                                <th scope="row">Computadora en Casa</th>
                                <td>@if($alumno->computadora==1) Si @else No @endif</td>
                            </tr>
                            <tr>
                                <th scope="row">Computadora Adecuada</th>
                                <td>@if($alumno->computadoraAdecuada==1) Si @else No @endif</td>
                                <th scope="row">Hábitos Alimenticios</th>
                                <td>@if($alumno->habitosAlimenticios==1) Si @else No @endif</td>
                            </tr>
                            <tr>
                                <th scope="row">Deportes</th>
                                <td>@if($alumno->deportes==1) Si @else No @endif</td>
                                <th scope="row">enfermedad</th>
                                <td>@if($alumno->enfermedad==1) Si @else No @endif</td>
                            </tr>
                            <tr>
                                <th scope="row">Discapacidad</th>
                                <td>@if($alumno->discapacidad==1) Si. @else No. @endif {{ $alumno->especificarDiscapacidad }}</td>
                                <th scope="row">Acoso Sexual</th>
                                <td>@if($alumno->acosoSexual==1) Si @else No @endif</td>
                            </tr>
                            <tr>
                                <th scope="row">Acoso Sexual UDG</th>
                                <td>@if($alumno->acosoSexualUdG==1) Si @else No @endif</td>
                                <th scope="row">Atención Psicológica</th>
                                <td>@if($alumno->atencionPsicologica==1) Si @else No @endif</td>
                                <td></td>
                                <td></td>
                            </tr>

                            </tbody>
                        </table>
                        <p><a href="{{ route('editarAlumno',['alumno_id' => $alumno->IdUser]) }}" class="btn btn-primary">Editar Expediente</a>

                    </div>
                </div>
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tutor Elegido</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                            @foreach($registro_tutor as $tutor)
                                @if(isset($tutor->tutorNombre))
                                <tr>
                                    <th scope="row">Nombre:</th>
                                    <td>{{ $tutor->tutorNombre }}</td>
                                    <th scope="row"></th>
                                    <td>{{ $tutor->apellidos }}</td>
                                    <th scope="row">Ciclo</th>
                                    <td>{{ $tutor->ciclo_tutoria }}</td>
                                </tr>
                                @else
                                    <tr>
                                        <th colspan="6">Sin Tutor Seleccionado</th>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        <p>
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('listaInscritosDT',$ciclo) }}" class="btn btn-primary">Ver alumnos con tutor {{$ciclo}}</a>
                <a href="{{ route('listaNoInscritosDT',$ciclo) }}" class="btn btn-primary">Ver alumnos sin tutor {{$ciclo}}</a>
            @else
                <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
            @endif
        </p>
        <p>En caso de tener algún problema, enviar correo a la Coordinación de la Licenciatura en Relaciones Internacionales: coordinacion.lri.udg@gmail.com</p>
        <div class="row">
            <br>

            <hr>
            <p>CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y HUMANIDADES.</p>
            <p>Licenciatura en Relaciones Internacionales</p>
            <p>Belenes</p>
        </div>
    </div>


@endsection
