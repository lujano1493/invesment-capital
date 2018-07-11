<div class=" well" > 
	<ul class="nav nav-tabs"  > 
		<li  class="active">
			<a href="#contrato-info" id="datos-contrato"  data-toggle="tab"  ">
			 <h6> Datos de Contrato </h6>
			</a>
		</li> 
		<li  >
			<a href="#info-cuenta-bancaria"  id="info-cuenta-tab" data-toggle="tab" >
				<h6> Cuentas Bancarias</h6>
			</a>
		</li>  
		<li  >
			<a href="#info-documentos"  id="info-documentos-tab" data-toggle="tab" >
				<h6> Estados de Cuenta</h6>
			</a>
		</li>  
	</ul> 
	<div class="tab-content tab-margin-top" > 
		<div class="tab-pane  fade active in"  id="contrato-info" > 
			@include("elements.investment.contract")

			@include("elements.investment.representants")
		</div> 

		<div class="tab-pane" id="info-cuenta-bancaria"> 
			@include("elements.investment.counts_bank")
		</div> 

		<div class="tab-pane" id="info-documentos"> 
			@include("elements.investment.documents")
		</div> 
		
	</div> 
</div>