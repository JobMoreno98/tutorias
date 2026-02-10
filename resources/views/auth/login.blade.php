@extends('layouts.app')

@section('css_content')
    <style>
        @media (min-width: 770px) {
            .border-none {
                border-right: 1px solid grey;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container" style="min-height:100vh;display:flex;align-items: center;justify-content: space-evenly;">
        <div class="row">
            <div class="card  border-0">
                <div class="card-body d-flex flex-wrap">

                    <div class="col-sm-12 col-md-5 border-md-end px-2 mx-2 border-none d-flex align-items-center">
                        <img src="{{ asset('images/logo.png') }}" class="img-fluid w-100" alt="">
                    </div>

                    <div class="col-sm-12 col-md-5 px-2 mx-2">
                        <h3 class="card-title border-bottom text-center pb-1 mb-1">Inicio de Sesi&oacute;n</h3>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label">Correo institucional</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-12 control-label">Contraseña</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Acceder
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        ¿Olvidaste la contraseña?
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
