
@php

	$user= Auth::user();
	$contrato= $user->contract;
	$countDepositos =  0;
	$countRetiros = 0;

	$depositos = collect([]); 
	$retiros = collect([]) ;
	$totalMovimientos= collect([]);

 if(isset($contrato)){
	$countDepositos= $contrato->transactions()->where(['id_status_transaction'  =>2 ,'id_type_transaction' => 1 ])->count() ;
	$countRetiros= $contrato->transactions()->where(['id_status_transaction'  =>2 ,'id_type_transaction' => 2 ])->count() ;
	$depositos = $contrato->transactions()
 			->groupBy('update_date')
 			->where(['id_status_transaction'  =>2 ,'id_type_transaction' => 1 ])
 			->get( [
 					DB::raw('SUM(amount) AS amount ') ,
 					DB::raw('DATE(updated_at) AS update_date ')
 					] );

	$retiros =$contrato->transactions()
 			->groupBy('update_date')
 			->where(['id_status_transaction'  =>2 ,'id_type_transaction' => 2 ])
 			->get( [
 					DB::raw('SUM(amount) AS amount ') ,
 					DB::raw('DATE(updated_at) AS update_date ')
 					] );
 	$totalMovimientos=$contrato->transactions()
 					->groupBy('id_type_transaction')
 					->where('id_status_transaction' ,2)
 					->get([
 						'id_type_transaction',
 						DB::raw('COUNT(id) AS total ')
 					]);

 }






@endphp



@if ( !isset($contrato))
	<div class="row">
		<div class="col-lg-12">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<i class="fa fa-warning fa-fw"></i>
						Sin Configuración de Contrato
					</div>
					<div class="panel-body">
							Parece ser que aún no tienes configurado un contrato. Para obtener más detalles favor de ponerse en contacto con el administrador.
					</div>

				</div>

		</div>
	</div>
@endif

<div class="row">
	@include("elements/user/new_notifications", [
			"colorClass" =>'panel-primary',
			"icon" =>'fa fa-arrow-up ',
			"dsc" => "Nuevos Depositos",
			"countNew" =>$countDepositos,
			"route" => "invesment/deposito"

		])

	@include("elements/user/new_notifications", [
			"colorClass" =>'panel-yellow',
			"icon" =>'fa fa-arrow-down',
			"dsc" => "Nuevos Retiros",
			"countNew" =>$countRetiros,
			"route" => "educacion/retiro"

		])
	@include("elements/user/new_notifications", [
			"colorClass" =>'panel-green',
			"icon" =>'fa fa-tasks',
			"dsc" => "Nuevos Cuestionarios",
			"countNew" =>"2",
			"route" => "educacion/asignacion"

		])
 
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>
				últimos Deposito
			</div>
			<div class="panel-body">
				@if($depositos->isNotEmpty())
					@include("elements/user/chart_investment_bar_simple", [
							"idChart" =>"ultimos-depositos",
							"type" => "bar",
							"s1" => [ $depositos->pluck("amount")],
							"ticks"=> $depositos->pluck("update_date") ,
							"barColors" => ["#337ab7"],
							"labels" =>["Depositos"]
						])
				@endif

			</div>
		</div>

	</div>

	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>
				 Últimos Retiros
			</div>
			<div class="panel-body">
				@if($retiros->isNotEmpty())
					@include("elements/user/chart_investment_bar_simple", [
						"idChart" =>"ultimos-retiros",
						"type" => "bar",
						"s1" => [ $retiros->pluck("amount")],
						"ticks"=> $retiros->pluck("update_date") ,
						"barColors" => ["#337ab7"],
						"labels" =>["Depositos"]
					])
				
				@endif
			</div>
		</div>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		@php
			$mo=$totalMovimientos->map(function ($item){
					return  [   $item['type']['name'] ,$item['total'] ];
				})->toArray();

		@endphp

		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>
				 Total de Movimientos
			</div>
			<div class="panel-body">
				@if(!empty( $mo ) )
				@include("elements/user/chart_investment_donut_simple", [
						"idChart" =>"total-movimientos",
						"title" =>"Total de Movimientos",
						"values" =>  [ $mo ]
					])
				@endif

			</div>
		</div>

	</div>
</div>