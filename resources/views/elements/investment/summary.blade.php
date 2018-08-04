@php

   $user=Auth::user();

   $contrato = $user->contract;

   $balances= collect([]);

   if( isset($contrato) ){
      $balances = $contrato->balances()->orderBy("id","desc")->take(2)->get() ;

   }

   $totalAportaciones=0;
   $minusvalia= 0;

   $porcetanjeMinusValia= 0;

   $saldoTotal=0;
   $fondoRentaV=0;
   $fondoDeuda=0;
   \Carbon\Carbon::setLocale("es");
   $fecha= \Carbon\Carbon::now();


   if($balances->count() > 0 ){
      $balance= $balances->get(0);
      $totalAportaciones=  $balance->balance;
      $saldoTotal=$balance->balance_total;
      $fondoRentaV = $balance->renta_variable;
      $fondoDeuda = $balance->deuda;
      $fecha= $balance->updated_at;
   }

   if( $balances->count() == 2 ){
      $balance1=  $balances->get(1);
      $minusvalia =   $saldoTotal-$balance1->balance_total;
      $porcetanjeMinusValia =  ($minusvalia/ $balance1->balance_total) *100;

   }
 
   
@endphp





<div class="well">

   @if($balances->count() > 0 )
      <div class="row">
      		<div class="col-lg-12 text-center">
      			<h5> MI RESUMEN</h5>
      		</div>
      </div>

       <div class="row">
      		<div class="col-xs-12  col-sm-4 text-center">
      			<h5> Total de Aportaciones</h5>
      			<h4>  @money($totalAportaciones) MXN</h4>
      		</div>
      		<div class="col-xs-12 col-sm-4 text-center {{ ($minusvalia <0) ? 'has-error' :'' }}">
               <label class="control-label"> {{  ($minusvalia <0) ?  'Minusvalia' :   'Plusvalia' }}</label>
              
      			<h4 class="control-label">  @money($minusvalia) MXN</h4>
      			<h6 class="control-label">  @percentage($porcetanjeMinusValia) </h6>
      		</div>
      		<div class="col-xs-12 col-sm-4 text-center">
      			<h5> Saldo Total</h5>
      			<h4>  @money($saldoTotal) MXN</h4>
      			<h6>  {{ $fecha->format('d-m-Y')}} </h6>
      		</div>
      </div>
      <div class="row">
         <div class="col-lg-12 ">
            <div class="form-group text-center">
               <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-retirar">
                  Solicitud Retiro de Efectivo
               </button>
            </div>
            
         </div>
      </div>
      <div class="row">
       
          <div class="col-lg-offset-4 col-lg-4">

            @php
               $mo = [ ['Fondo Renta Variable', $fondoRentaV ] ,['Fondo Deuda' ,$fondoDeuda ]  ];
            @endphp
            @if(!empty( $mo ) )
            @include("elements/user/chart_investment_pie_simple", [
                  "idChart" =>"distribucion-fondos",
                  "title" =>"Distribución de Fondos",
                  "values" =>  [ $mo ]
               ])
            @endif
         </div>

         <div class=" col-lg-12 text-center">
            <h6   style="width: 60% ;margin-left: auto;margin-right: auto;"> 
               Esta es la distribución real de tu estrategia. Por la naturaleza de los fondos,
            puede variar ligeramente a la que configuraste en un inicio</h6>
           
         </div>
      </div>
      @else
      <div class="row">
         <div class="col-lg-12">
               <div class="panel panel-warning">
                  <div class="panel-heading">
                     <i class="fa fa-warning fa-fw"></i>
                     Sin Configuración de Saldo
                  </div>
                  <div class="panel-body">
                        Parece ser que aún no tienes configurado el saldo actual. Para obtener más detalles favor de ponerse en contacto con el administrador.
                  </div>
               </div>
         </div>
      </div>
      @endif
</div>


<div class="modal fade" id="modal-retirar" tabindex="-1" role="dialog" aria-labelledby="labelModalNickname" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="labelModalNickname"> Petición de Retiro de Efectivo   </h4>
            </div>
            <div class="modal-body">
               {{ Form::open( array('route' =>['capital.retirar' ] )) }}
                <div class="row">
                        <div class="col-sm-12">
                            {{ Form::bsInput('retirar','text',[
                                'label' => ['text' => 'Monto a retirar', 'class' =>'control-label'],
                                'attr' => [
                                        'id' => 'retirar',
                                        'placeholder' => 'Ingresa monto a retirar',
                                        'required' =>true
                                    ]
                                ]
                            )
                            }}
                            
                        </div>
                </div>
                <div class="form-group text-center">
                   {{ Form::Button('Realizar Retiro' , ['class' => 'btn btn-primary btn-ajax' , 'type' =>'submit' ]  ) }}
               </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

