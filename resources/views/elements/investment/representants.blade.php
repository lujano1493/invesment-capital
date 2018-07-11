
@php
  $contrato= Auth::user()->contract;
  $representantes=   isset($contrato )  ?  $contrato->representants : null;

@endphp


@isset( $representantes )
  <div class="panel-group" id="representantes-accodion" >
    @foreach ( $representantes as $representante)
    <div class="panel panel-primary">
      <div class="panel-heading" >
        <h4 class="panel-title">
          <a  data-toggle="collapse" data-parent="#representantes-accodion" href="#repre-acor{{ $loop->index +1 }}" >
              {{ $representante->typeRepresent->name  }} - {{ $representante->name }} {{ $representante->last_name }} {{ $representante->last_second_name }}
          </a>
        </h4>
      </div>
      <div id="repre-acor{{ $loop->index +1 }}" class="panel-collapse collapse"  >
        <div class="panel-body">
           @include("elements.investment.representant" , compact('representante'))
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endisset