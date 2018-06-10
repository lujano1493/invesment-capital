

<div id="{{ $idChart }}" class="chart-morris" 
	data-type ="{{$type}}" 
	data-data="{{ json_encode($data ) }}" 
	@if (isset($xkey)  )
		data-xkey="{{  json_encode($xkey)  }}" 
	@endif
	@if (isset($ykeys)  )
	data-ykeys="{{    json_encode($ykeys)   }}" 
	@endif
	@if (isset($labels)  )
		data-labels ="{{ json_encode($labels) }}"
	@endif
	@if (isset($barColors)  )
		data-bar-colors="{{ json_encode($barColors) }}"
	@endif

	@if (isset($colors)  )
		data-colors="{{ json_encode($colors) }}"
	@endif
	>
	

</div>