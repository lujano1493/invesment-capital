<div class="row">
	@include("elements/user/new_notifications", [
			"colorClass" =>'panel-primary',
			"icon" =>'fa fa-arrow-up ',
			"dsc" => "Nuevos Depositos",
			"countNew" =>"5",
			"route" => "invesment/deposito"

		])

	@include("elements/user/new_notifications", [
			"colorClass" =>'panel-yellow',
			"icon" =>'fa fa-arrow-down',
			"dsc" => "Nuevos Retiros",
			"countNew" =>"3",
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
				@include("elements/user/chart_morris", [
						"idChart" =>"ultimos-deposito",
						"type" => "bar",
						"data" =>  [    
							["fecha"=>"2018-05-30" , "deposito" =>14  ],   
							["fecha"=>"2018-06-02" , "deposito" =>20  ],   
							["fecha"=>"2018-06-03" , "deposito" =>30  ],   
							["fecha"=>"2018-06-04" , "deposito" =>30  ],
							["fecha"=>"2018-06-07" , "deposito" =>15  ]
							] ,
						"xkey" => ["fecha"],
						"ykeys"=> ["deposito"],
						"barColors" => ["#337ab7"],
						"labels" =>["Depositos"]
					])
				

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
				@include("elements/user/chart_morris", [
						"idChart" =>"ultimos-retiros",
						"type" => "bar",
						"data" =>  [    
							["fecha"=>"2018-06-04" , "retiro" =>10  ],
							["fecha"=>"2018-06-07" , "retiro" =>30  ]
							] ,
						"xkey" => ["fecha"],
						"ykeys"=> ["retiro"],
						"barColors" => ["#f0ad4e"],
						"labels" =>["Retiros"]
					])

			</div>
		</div>
		
	</div>
</div>

<div class="row">
	<div class="col-lg-12">


		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>
				 Total de Movimientos
			</div>
			<div class="panel-body">
				@include("elements/user/chart_morris", [
						"idChart" =>"total-movimientos",
						"type" => "donut",
						"colors" => ["#337ab7","#f0ad4e"],
						"data" =>  [    ["label"=>"Depositos" , "value" =>5  ]  ,  ["label" => "Retiros" , "value"=> 2  ]  ] 
					])

			</div>
		</div>

	</div>
</div>