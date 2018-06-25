
@if (session('alert'))

	@php
		$attr_clss =  Auth::user()->isAdmin() ? "alert-dismissible fade show" : ""; 	
		$attr_clss_status  = session('alert.status') === 'ok' ? 'alert-success' :  
    		(   session('alert.status')==='warning' ? 'alert-warning'   :'alert-danger') ;

    	$floatStyleClss = isset($floatMsg) &&  $floatMsg  ? 'home-float-alert' : '';
	@endphp

    <div class="alert  {{  $attr_clss_status }}  {{ $attr_clss }} {{ $floatStyleClss }}   " role="alert" >
        {{ session('alert.message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
    </div>
@endif