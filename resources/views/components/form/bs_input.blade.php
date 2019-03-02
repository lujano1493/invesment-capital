@php
	
		$user = Auth::user();
			 /** checamos que boostrap ocupamos
					$isBoos4   true : -  Boostrap4
					$isBoos4 false : - Boostrap3
	
			 */
		$isBoos4 = $user && $user->isAdmin();
	//	if( !$user ){
	//		$isBoos4 = true; 
	//	}
		
		$ClassFormGroup =  !$isBoos4 && $errors->has($name)?  "has-error":"";

@endphp


@if( $type !== "hidden" )
	<div class="form-group {{$ClassFormGroup}} " >
@endif


	@php
		$_defaultLabel = [ 'class' =>'' , 'text'=> $name ];
		if( isset($options['label']) &&  is_array($options['label'])){
		 	$label = array_merge(  $_defaultLabel,$options['label']  );
		}else if(  isset($options['label']) && $type !== "hidden"   ){
			$label = array_merge( $_defaultLabel ,[ 'text' =>$options['label'] ]      );
		}
		else{
			$label =[];
		}
		if( $type == 'select'){
			$options['list'] = isset($options['list'])? $options['list'] :[]; 
			if(isset($options['empty_option'])){
				$options['list'][""]= $options['empty_option'];

			}
		}

	@endphp
	@if (  !empty($label)  )
    	{{ Form::label($name,   $label['text']    , ['class' =>  $label['class']   ]) }}
    @endif


	 @php
			$attr=  isset( $options['attr'] ) ?   array_merge(['class' =>''], $options['attr']) : [ 'class' =>''];

			if(  isset($options['elementIndex'])) {
				
				$ident=  "{$name}_{$options['elementIndex']}";
				$attr= array_merge($attr , [  'id' => $ident  , 'name' => $ident  ]  );
			}

			$invalid= $isBoos4 &&  $errors->has($name) && $type!== "hidden" ? 'is-invalid' :''  ;
			$attr['class'] = $attr['class']. ' form-control '. $invalid;

			if(!isset($options['value'] )){
				$options['value' ] =null;
			}
	@endphp

  	@if ( $type ==='text'  )
		{{ Form::text($name, $options['value'], $attr  ) }}
  	@elseif ( $type ==='number'  )
		{{ Form::number($name, $options['value'], $attr  ) }}
	@elseif ( $type ==='textarea'  )
		{{ Form::textarea($name, $options['value'], $attr  ) }}
	@elseif ($type ==='password')
		{{ Form::password($name, $attr  ) }}
	@elseif ($type ==='email')
		{{ Form::email($name,$options['value'], $attr  ) }}
	@elseif ($type ==='date')
		{{ Form::date($name,$options['value'], $attr  ) }}
	@elseif ($type ==='time')
		{{ Form::time($name,$options['value'], $attr  ) }}
	@elseif ($type ==='select')
		{{ Form::select($name, $options['list']  ,$options['value'], $attr  ) }}
	@elseif ($type ==='file')
		{{ Form::file($name, $attr ) }}
	@elseif ($type ==='hidden')
		{{ Form::hidden($name, $options['value'] , $attr  ) }}
	@endif


	@if ( isset( $options['value_current']) )   
		@php	
			$identHidden=   (!isset($options['elementIndex']) ? $name : $ident).'_current' ;
		@endphp


		{{ Form::hidden($name ,$options['value'] , [ 'id' =>  $identHidden ,  'name' => $identHidden  ]  ) }}
  	
  	@endif


 	@if (  $isBoos4&&$errors->has($name) && $type !== "hidden" )
 		@foreach(  $errors->get($name) as  $error   )
	    <span class="invalid-feedback">
	        <strong>{{ $error }}</strong>
	    </span>
	    @endforeach
	@endif


 	@if (  !$isBoos4&&$errors->has($name) && $type !== "hidden" )
 		@foreach(  $errors->get($name) as  $error   )
	    <label class="control-label">
	        {{ $error }}
	    </label>
	    @endforeach
	@endif

@if( $type !== "hidden" )
	</div>
@endif