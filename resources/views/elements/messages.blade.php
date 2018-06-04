
@if (session('alert'))

    <div class="alert  {{ session('alert.status') === 'ok' ? 'alert-success' :  
    		(   session('alert.status')==='warning' ? 'alert-warning'   :'alert-danger')   }}  alert-dismissible fade show" role="alert" >
        {{ session('alert.message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
    </div>
@endif