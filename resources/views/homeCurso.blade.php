@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (Auth::check())
                <div class="col-md-12">
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
                    @if (Auth::user()->role == 'admin')
                        <div class="panel panel-default">
                            <div class="panel-body">

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4>Ciclo escolar - {{ $ciclo }}</h4>
                                <hr>
                                <a class="btn btn-sm btn-primary" href="{{ route('listaInscritosDT', ['ciclo' => $ciclo]) }}">Ya
                                    inscritos con
                                    tutor</a>
                                <a class="btn btn-sm btn-primary" href="{{ route('listaNoInscritosDT', ['ciclo' => $ciclo]) }}">Sin
                                    inscripción a
                                    tutor</a>
                                <a class="btn btn-sm btn-primary" href="{{ route('listaTutorias', ['ciclo' => $ciclo]) }}">Listado
                                    de
                                    Tutorías</a>
                            </div>
                        </div>

                        <div class="card my-2">
                            <div class="card-body">
                                <h4>Administración - {{ $ciclo }}</h4>
                                <hr>
                                <a class="btn btn-sm btn-primary" href="{{ route('listaTutores') }}">Listado de
                                    Tutores</a>
                                <a class="btn btn-sm btn-success" href="{{ route('createTutor') }}">Capturar Tutores</a>
                                <a class="btn btn-sm btn-success" href="{{ route('createTutoria') }}">Capturar
                                    Tutorías</a>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
