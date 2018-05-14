@extends('layouts.credential')

@section('title','Recuperación de Contraseña')
@section('page-title','Recuperación de Contraseña')

@section('content')

  <form method="POST" action="{{ route('restore_password',$token) }}">
      {{ csrf_field() }}

    <input type="hidden" name="token" value="{{ $token }}">


    <div class="form-group ">
        <label for="password" class="col-md-12 control-label">Contraseña:</label>

         <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
    </div>

    <div class="form-group ">
        <label for="password-confirm" class="col-md-12 control-label">Confirmar contraeña</label>
         <input id="password-confirm" type="password" class="form-control {{ $errors->has('password_confirmation') ? ' has-error' : '' }}" name="password_confirmation" required>

            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
    </div>

     <div class="form-group">
         <button type="submit" class="btn btn-primary btn-block" > Restablecer Contraseña</button>
    </div>

  
  </form>



@endsection