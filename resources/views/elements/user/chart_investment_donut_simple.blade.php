

<div id="{{ $idChart }}" class="chart-investment" 
	data-type ="donut" 

	@if (isset($values)  )
		data-values="{{  json_encode($values)  }}" 
	@endif

	@if (isset($title)  )
		data-title ="{{ $title }}"
	@endif

	@if (isset($colors)  )
		data-colors="{{ json_encode($colors) }}"
	@endif
	>
	

</div>