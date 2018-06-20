<div class="row">
		 <ul class="nav nav-pills nav-capital-home"> 
		 	@foreach ( [ 
		 			['route' =>'home' ,'title' =>'Inicio' ] ,
		 			['route' =>'login' ,'title' =>'Login' ] ,
		 			['route' =>'quienes_somos' ,'title' =>'¿Qué es Capital 444?' ],
		 			['route' =>'servicios' ,'title' =>'Servicios' ],
		 			['route' =>'contacto' ,'title' =>'Contactanos']
		 			]  as  $opcion)

		 		<li role="presentation"   class={{ Route::is($opcion['route']) ? "active":''}} >
		   			<a href="{{ route($opcion['route']) }}">{{ $opcion['title'] }}</a>
		   		</li>
		 	@endforeach 
		</ul> 
		<div class="line-home-bottom"></div>
	</div>