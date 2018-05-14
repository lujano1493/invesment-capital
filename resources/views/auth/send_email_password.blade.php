@extends('layouts.credential')

@section('title','Restablecer Contraseña')
@section('page-title','Restablecer Contraseña')

@section('content')

  <form method="POST" action="{{ route('send_email_password') }}">
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
      <div class="form-group">
           <button class="btn btn-primary btn-block" type="submit">Enviar Correo de Recuperación</button>
      </div>
  </form>
    <div class="row">
        <div class="col-12">
            <div class="form-group text-center">
                 <a class="d-block small" href="{{ route('login') }}">Iniciar Sesión</a>
            </div>
            
        </div>
    </div>


@endsection