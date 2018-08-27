
@php
		$user = Auth::user();
	$isAdmin =  isset($user) ? $user->isAdmin() : false;

	$id = isset($options['id'])?  $options['id'] : $name;
	$disabled = isset($options['disabled'])?  $options['disabled'] :false;
	$attr= [   'id' =>  $id  ,'class' => $isAdmin ? 'form-check-input' :''  ,'disabled' => $disabled];
	$attr =  isset($options['attr'])  ? array_merge($attr , $options['attr'])  :$attr ;
@endphp

@if($isAdmin)
	
	<div class="form-check form-check-inline {{ isset($options['clsExtra']) ? $options['clsExtra'] : '' }} ">


		@if( $type ==='checkbox' )
		{{ Form::checkbox(  $name  , isset($options['value'])? $options['value'] : null , isset($options['checked'])? $options['checked']:null ,
			$attr) }}
		@elseif( $type==='radio' )
			{{ Form::radio(  $name  , isset($options['value'])? $options['value'] : null , isset($options['checked'])? $options['checked']:null ,
			 $attr) }}
		@endif
		@isset($options['label'])
			<label class="form-check-label" for="{{ $options['id']  }}">
				{{ $options['label'] }}
			</label>
		@endisset
	</div>
@else 
	<div class="checkbox  {{ isset($options['clsExtra']) ? $options['clsExtra'] : '' }} ">
	    <label>

	    @if( $type ==='checkbox' )
			{{ Form::checkbox(  $name  , isset($options['value'])? $options['value'] : null , isset($options['checked'])? $options['checked']:null ,
				$attr) }}
			@elseif( $type==='radio' )
				{{ Form::radio(  $name  , isset($options['value'])? $options['value'] : null , isset($options['checked'])? $options['checked']:null ,
				$attr ) }}
			@endif
	     
	      	@isset($options['label'])
				{{ $options['label'] }}
			@endisset
	    </label>
  </div>



@endif