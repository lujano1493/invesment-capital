@php
	
		$user = Auth::user();
			 /** checamos que boostrap ocupamos
					isAdmin  : -  Boostrap4
					isNotAdmin : - Boostrap3
	
			 */
		$isAdmin = $user && $user->isAdmin();
		if( !$user ){
			$isAdmin = true; 
		}
		
		$ClassFormGroup =  !$isAdmin && $errors->has($name)?  "has-error":"";

@endphp


@if( $type !== "hidden" )
	<div class="form-group {{$ClassFormGroup}} " >
@endif


	@php

		extract($options);
		$_defaultLabel = [ 'class' =>'' , 'text'=> $name ];
		if( isset($options['label']) &&  is_array($options['label'])){
		 	$label = array_merge(  $_defaultLabel,$label  );
		}else if(  isset($options['label']) && $type !== "hidden"   ){
			$label = array_merge( $_defaultLabel ,[ 'text' =>$label ]      );
		}
		else{
			$label =[];
		}
		if( $type == 'select'){
			$options['list'] = isset($options['list'])? $options['list'] :[]; 
		}

	@endphp
	@if (  !empty($label)  )
    	{{ Form::label($name,   $label['text']    , ['class' =>  $label['class']   ]) }}
    @endif


	 @php
			$attr=  isset( $options['attr'] ) ?   array_merge(['class' =>''], $options['attr']) : [ 'class' =>''];
			if(  isset($options['elementIndex'])) {
				$ident=  "{$name}_{$elementIndex}";
				$attr= array_merge($attr , [  'id' => $ident  , 'name' => $ident  ]  );
			}

			$invalid= $isAdmin &&  $errors->has($name) && $type!== "hidden" ? 'is-invalid' :''  ;
			$attr['class'] = $attr['class']. ' form-control '. $invalid;

			if(!isset($options['value'] )){
				$options['value' ] =null;
			}
	@endphp

  	@if ( $type ==='text'  )
		{{ Form::text($name, $options['value'], $attr  ) }}
	@elseif ($type ==='password')
		{{ Form::password($name, $attr  ) }}
	@elseif ($type ==='email')
		{{ Form::email($name,$options['value'], $attr  ) }}
	@elseif ($type ==='date')
		{{ Form::date($name,$options['value'], $attr  ) }}
	@elseif ($type ==='select')
		{{ Form::select($name, $options['list']  ,$options['value'], $attr  ) }}
	@elseif ($type ==='hidden')
		{{ Form::hidden($name, $options['value'] , $attr  ) }}
	@endif


	@if ( isset( $options['value_current']) )   
		@php	
			$identHidden=   (!isset($options['elementIndex']) ? $name : $ident).'_current' ;
		@endphp


		{{ Form::hidden($name ,$options['value'] , [ 'id' =>  $identHidden ,  'name' => $identHidden  ]  ) }}
  	
  	@endif
 	@if ($errors->has($name) && $type !== "hidden" )
	    <span class="invalid-feedback">
	        <strong>{{ $errors->first($name) }}</strong>
	    </span>
	@endif

@if( $type !== "hidden" )
	</div>
@endif