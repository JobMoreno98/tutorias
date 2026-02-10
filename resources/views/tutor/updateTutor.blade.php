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
                <h2>Actualizar Información de Tutores</h2>
                <hr>
                <p>* Campos Obligatorios</p>
                <form action="{{ route ('updateTutor',['tutor_id'=>$tutor->id]) }}" method="post" enctype="multipart/form-data" class="col-md-12">
                    {!! csrf_field() !!}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                Debe de llenar los campos marcados con un asterisco (*)
                            </ul>
                        </div>
                    @endif
                    <div class="form-group col-md-2 col-xs-12">
                        <label for="id">ID*</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$tutor->id}}" readonly>
                    </div>
                    <div class="form-group col-md-5 col-xs-12">
                        <label for="nombre">Nombre*</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$tutor->nombre}}" >
                    </div>
                    <div class="form-group col-md-5 col-xs-12">
                        <label for="apellidos">Apellidos *</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{$tutor->apellidos}}" >
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <label for="email">Correo (s) Electrónico (s) *</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$tutor->correo}}" >
                    </div>
                    <div class="form-group col-md-12 col-xs-12">
                        <label for="apellidos">Semblanza *</label>
                        <input type="text" class="form-control" id="semblanza" name="semblanza" value="{{$tutor->semblanza}}" >
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">Guardar datos</button>

                </form>
            </div>
        @else
            Usuario No válido
        @endif
    </div>
@endsection
