

<div id="{{ $idChart }}" class="chart-investment" 
	data-type ="{{$type}}" 

	@if (isset($s1)  )
		data-s1="{{    json_encode($s1)   }}" 
	@endif
	@if (isset($ticks)  )
		data-ticks="{{  json_encode($ticks)  }}" 
	@endif

	@if (isset($title)  )
		data-title ="{{ json_encode($title) }}"
	@endif
	@if (isset($barColors)  )
		data-bar-colors="{{ json_encode($barColors) }}"
	@endif

	@if (isset($colors)  )
		data-colors="{{ json_encode($colors) }}"
	@endif
	>
	

</div>