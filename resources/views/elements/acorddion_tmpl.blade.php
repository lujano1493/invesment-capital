<div class="card {{  isset($extraClsTmpl) ? $extraClsTmpl:'' }}">
	<div class="card-header">
		<h5>
		<button class="btn title-acor-btn btn-link" data-toggle="collapse" data-target="{{ $target }}" aria-expanded="true" aria-controls="{{ $idTarget }}">
			{{ $title }}
 		</button>
		</h5>
		
		
	</div>
	<div id="{{ $idTarget }}" class="collapse {{  isset($show) && $show ? 'show':'' }} " data-parent="{{ $parent }}">
		<div  class="card-body" >
			{!! $body !!}
		</div>
	</div>
</div>