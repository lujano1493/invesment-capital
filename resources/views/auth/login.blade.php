@extends('layouts.credential')

@section('title','Iniciar Sesión')
@section('page-title', 'Iniciar Sesión')
@section('content')

    <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
      <div class="form-group ">
            <label for="email" class="col-md-12 control-label">Correo Electrónico:</label>
            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="ingresa correo" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group ">
            <label for="password" class="col-md-12 control-label">Contraseña:</label>
            <input id="password" type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="ingresa contraseña" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
        </div>
   
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar Contraseña
                </label>
            </div>
        </div>
        <div class="form-group">
             <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
        </div>
         
    </form>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                 <a class="d-block small" href="{{ route('send_email_password') }}">¿Olvidaste Contraseña?</a>
            </div>
            
        </div>
        <div class="col-6">
            <div class="form-group">
                 <a class="d-block small" href="{{ route('send_email_activation') }}">¿Aún no activas tu cuenta?</a>
            </div>
           
        </div>
        <!--<a class="d-block small mt-3" href="{{ route('register') }}">Registrate</a>-->
    </div>

@endsection
