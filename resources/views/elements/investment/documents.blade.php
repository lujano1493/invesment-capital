
@php
	$contrato = Auth::user()->contract;

	$documentos= isset($contrato) ? $contrato->documents: [];
@endphp

@foreach($documentos as $documento )
	@php
		$numero=$loop->index +1;
	@endphp
	@include("elements.investment.document",compact('documento','numero'))

@endforeach