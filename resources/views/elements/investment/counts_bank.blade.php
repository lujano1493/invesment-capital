@php
		$contrato = Auth::user()->contract;
		$representantes= isset($contrato) ?  $contrato->representants : [];
		$numero =0;
@endphp

@foreach ($representantes as $representante)
	@php
		$cuentas = $representante->count_banks;
		$nombreCompleto = $representante->name . ' '. $representante->last_name .' '. $representante->last_second_name;
	@endphp

	@if(  $cuentas->isNotEmpty() )

	<div class="panel panel-primary">
		<div class="panel-heading"> 
			<h4 class="panel-title">
				  {{ $nombreCompleto }}
			</h4>
		
		</div>
		<div class ="panel-body">
			@foreach( $cuentas as $cuenta)
				@php
					$numero++;
				@endphp
				@include("elements.investment.count_bank" , compact('cuenta','numero'))
			@endforeach
			
		</div>
	</div>

	@endif
	
@endforeach