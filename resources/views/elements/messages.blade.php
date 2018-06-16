
@if (session('alert'))

	@php
		$attr_clss =  !Auth::user() || Auth::user()->isAdmin() ? "alert-dismissible fade show" : ""; 	
		$attr_clss_status  = session('alert.status') === 'ok' ? 'alert-success' :  
    		(   session('alert.status')==='warning' ? 'alert-warning'   :'alert-danger') ;
	@endphp

    <div class="alert  {{  $attr_clss_status }}  {{ $attr_clss }} " role="alert" >
        {{ session('alert.message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
    </div>
@endif