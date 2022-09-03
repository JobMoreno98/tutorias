@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Auth::user()->role == 'admin')
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>

                </div>
            @endif
            <div class="row">
                <h2>Registro de Tutores</h2>
                <hr>
                <p>* Campos Obligatorios</p>
                <form action="{{ route ('saveTutor') }}" method="post" enctype="multipart/form-data" class="col-md-12">
                    {!! csrf_field() !!}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                Debe de llenar los campos marcados con un asterisco (*)
                            </ul>
                        </div>
                    @endif
                    <div class="form-group col-md-3 col-xs-12">
                        <label for="nombre">Nombre*</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{old('nombre')}}" >
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label for="apellidos">Apellidos *</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{old('apellidos')}}" >
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label for="email">Correo (s) Electrónico (s) *</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" >
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <label for="apellidos">Semblanza *</label>
                        <input type="text" class="form-control" id="semblanza" name="semblanza" value="{{old('semblanza')}}" >
                    </div>
                    <button type="submit" class="btn btn-success">Guardar datos</button>

                </form>
            </div>
        @else
            Usuario No válido
        @endif
    </div>
@endsection
