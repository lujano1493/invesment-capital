
<div class="well">
   <div class="row">
   		<div class="col-lg-12 text-center">
   			<h5> MI RESUMEN</h5>
   		</div>
   </div>

    <div class="row">
   		<div class="col-xs-12  col-sm-4 text-center">
   			<h5> Total de Aportaciones</h5>
   			<h4> $ 6,991,096 MXN</h4>
   		</div>
   		<div class="col-xs-12 col-sm-4 text-center">
   			<h5> Minusvalia</h5>
   			<h4> $ -35,288 MXN</h4>
   			<h6> -0.50%</h6>
   		</div>
   		<div class="col-xs-12 col-sm-4 text-center">
   			<h5> Saldo Total</h5>
   			<h4> $ 6,955,808.90 MXN</h4>
   			<h6> Al 10 de Abril 2018</h6>
   		</div>
   </div>
   <div class="row">
      <div class="col-xs-12  col-sm-4 text-center">
         <button class="btn btn-success" type="button">
            Solicitud Retiro Efectivo
         </button>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12  col-sm-4 text-left">
         <h6> Esta es la distribución real de tu estrategia. Por la naturaleza de los fondos,
         puede variar ligeramente a la que configuraste en un inicio</h6>
        
      </div>
       <div class="col-xs-12  col-sm-8">
         @include("elements/user/chart_morris", [
                  "idChart" =>"total-porcentaje-estrategia",
                  "type" => "donut",
                  "colors" => ["#337ab7","#f0ad4e"],
                  "data" =>  [    ["label"=>"F. Renta V." , "value" => 70 ]  ,  ["label" => "F. Deuda" , "value"=> 30  ]  ] 
               ])
      </div>

     

   </div>
</div>