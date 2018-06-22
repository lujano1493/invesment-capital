<div class="row">

		<div class="margin-home-top col-xs-12 col-sm-6 col-md-6 col-lg-6  col-xs-offset-0 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
			<ul class="nav nav-pills nav-capital-home"> 
			 	@foreach ( [ 
			 			['route' =>'home' ,'title' =>'Inicio' ] ,
			 			['route' =>'quienes_somos' ,'title' =>'Sobre nosotros' ],
			 			['route' =>'contacto' ,'title' =>'Contactanos']
			 			]  as  $opcion)

			 		<li role="presentation"   class={{ Route::is($opcion['route']) ? "active":''}} >
			   			<a href="{{ route($opcion['route']) }}">{{ $opcion['title'] }}</a>
			   		</li>
			 	@endforeach 
			 	
			</ul> 
			
		</div>
		<div class="col-xs-12  col-sm-4 col-md-4  col-lg-4 ">
			<img  id="logo-home-capital" class="img-responsive " src="/img/logo_for_negro_min.png">
		</div>
	</div>

<div class="line-home-bottom"></div>