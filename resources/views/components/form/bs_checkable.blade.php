<div class="form-group">
	<div class="form-check">
	@php
		extract($options);

		$_defaultLabel = [ 'class' =>'' , 'text'=> $name ];
		if(is_array($label)){
		 	$label = array_merge(  $_defaultLabel,$label  );
		}else{
			$label = array_merge( $_defaultLabel ,[ 'text' =>$label ]      );
		}
		if(!isset($options['attr']) ){
			$options['attr'] = [];
		}
		$attr=$options['attr'];

	@endphp

	<label class="form-check-label {{ $label['class'] }}">
		@if ( $type ==='checkbox'  )
			{{ Form::checkbox($name,$value,$checked,  $attr ) }}
		@elseif ($type ==='password')
			{{ Form::radio($name,$value,$checked,$options  ) }}
		@endif

		@if (  !empty($label)  )
    		{{ $label['text']  }}
    	@endif
  	
	</label>
  
 	@if ($errors->has($name))
	    <span class="invalid-feedback">
	        <strong>{{ $errors->first($name) }}</strong>
	    </span>
	@endif
		
	</div>
	
</div>