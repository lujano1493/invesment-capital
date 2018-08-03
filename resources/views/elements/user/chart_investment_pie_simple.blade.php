

<div id="{{ $idChart }}" class="chart-investment" 
	data-type ="pie" 

	@if (isset($values)  )
		data-values="{{  json_encode($values)  }}" 
	@endif

	@if (isset($title)  )
		data-title ="{{ json_encode($title) }}"
	@endif

	@if (isset($colors)  )
		data-colors="{{ json_encode($colors) }}"
	@endif
	>
	

</div>