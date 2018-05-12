@extends('layouts.credential')

@section('content')


<div class="card card-login mx-auto mt-5">
      <div class="card-header">Iniciar Sesión</div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Correo</label>
                <input id="email" type="email" class="form-control" name="email" placeholder="ingresa correo" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Contraseña</label>
                <input id="password" type="password" class="form-control" name="password" placeholder="ingresa contraseña" required>
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
        
          <button class="btn btn-primary btn-block" href="index.html">Ingresar</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="{{ route('register') }}">Registrate</a>
          <a class="d-block small" href="{{ route('password.request') }}">¿Olvidaste Contraseña?</a>
        </div>
      </div>
    </div>

@endsection
