<div class="form-group">
	@php

		extract($options);
		$_defaultLabel = [ 'class' =>'' , 'text'=> $name ];
		if(is_array($label)){
		 	$label = array_merge(  $_defaultLabel,$label  );
		}else{
			$label = array_merge( $_defaultLabel ,[ 'text' =>$label ]      );
		}
	@endphp
	@if (  !empty($label)  )
    	{{ Form::label($name,   $label['text']    , ['class' =>  $label['class']   ]) }}
    @endif


	 @php
			$attr= array_merge(['class' =>''], $options['attr']);
			$invalid= $errors->has($name) ? 'is-invalid' :''  ;
			$attr['class'] = $attr['class']. ' form-control '. $invalid;
	@endphp

  	@if ( $type ==='text'  )
		{{ Form::text($name, $options['value'], $attr  ) }}
	@elseif ($type ==='password')
		{{ Form::password($name, $attr  ) }}
	@elseif ($type ==='email')
		{{ Form::email($name,$options['value'], $attr  ) }}
	@elseif ($type ==='date')
		{{ Form::date($name,$options['value'], $attr  ) }}
	@endif
  	
 	@if ($errors->has($name))
	    <span class="invalid-feedback">
	        <strong>{{ $errors->first($name) }}</strong>
	    </span>
	@endif
</div>