{{ Form::bsInput('id' ,'hidden' ) }}
{{ Form::bsInput('id_user' ,'hidden', ['value' => $user->id]) }}
{{ Form::bsInput('id_contract' ,'hidden', ['value' => $contrato->id]) }}
{{ Form::bsInput('count' ,'hidden', ['value' => $count]) }}


		<div class="row">
			<div class="col-12 col-sm-4">
				<label> Deposito Total	
				</label>
				<div class="input-group  mb-3">

					<span class="input-group-prepend">
						<button class="btn btn-calcular btn-outline-secondary"
						 data-type="remote" 
						 data-url="{{ route("admin.users.calcula.depositos", $user) }}" 
						 data-target="[name='payments']"
						type="button">Calcular</button>
					</span>
					{{ Form::number('payments'  , old('payments') ,  ['required' => true,'class' => 'form-control input-calc','data-type-calc' =>'add' ] ) }}
				</div>
				
			</div>


			<div class="col-12 col-sm-4">

				<label> Retiro Total
				</label>
					<div class="input-group  mb-3">
						<span class="input-group-prepend">
							<button class="btn btn-calcular btn-outline-secondary" 
							data-type="remote" 
							data-url="{{ route("admin.users.calcula.retiros", $user) }}"
							data-target="[name='withdrawals']"
							type="button">Calcular</button>
						</span>
						{{ Form::number('withdrawals'  , old('withdrawals') ,  ['required' => true,'class' => 'form-control input-calc' ,'data-type-calc' =>'sub' ] ) }}
					</div>
				
			</div>


			<div class="col-12 col-sm-4">
				<label> Saldo Base
				</label>
					<div class="input-group  mb-3">
						<span class="input-group-prepend">
							<button class="btn btn-calcular btn-outline-secondary" 
									data-type="sum"
									data-target="[name='balance']"
									data-inputs = "[name='payments'],[name='withdrawals']"
									type="button">Calcular</button>
						</span>
						{{ Form::number('balance'  , old('balance') ,  ['required' => true,'class' => 'form-control input-calc' ,'data-type-calc' =>  "value" ] ) }}
					</div>
				
			</div>
			
		</div>

			<div class="row">

			<div class="col-12 col-sm-4">
				<label> -Minusvalia/ +Plusvalia 
				</label>
				<div class="input-group  mb-3">
					<span class="input-group-prepend">
							<button class="btn btn-calcular btn-outline-secondary" 
								type="button"
								data-type="valiaInversoPercent"
								data-target="[name='change']"

								>Calcular</button>
						</span>
					{{ Form::number('change'  , old('change') ,  ['required' => true,'class' => 'form-control ', 'data-type-calc' =>  "percent" ] ) }}
					<div class="input-group-append" >
						<span class="input-group-text">
						%
						</span>
					</div>
				</div>
				
			</div>

			<div class="col-12 col-sm-4">
				<label> Saldo Total
				</label>
					<div class="input-group  mb-3">
						<span class="input-group-prepend">
							<button class="btn btn-calcular btn-outline-secondary" 
								type="button"
								data-type="ValiaPercentage"

								data-target="[name='balance_total']"

								>Calcular</button>
						</span>
						{{ Form::number('balance_total'  , old('balance_total') ,  ['required' => true,'class' => 'form-control input-calc','data-type-calc' =>'result'] ) }}
					</div>
				
			</div>

			<div class="col-12 col-sm-4">
				{{ Form::bsInput('id_status_balance' ,'select' , [ 
					'label' =>'Saldo Base',
					'value' =>old('id_status_balance'),
					'list' => $catStatusBalance,
					'attr' =>[
						'required' =>true
					]   
					]) }}
			</div>
	
		
		</div>
	
		<div class="row">
			

				<div class="col-12 col-sm-4">
					<label> Fondos R. V.
					</label>
					<div class="input-group mb-3">
						{{ Form::number('renta_variable'  , old('renta_variable') ,  ['required' => true,'class' => 'form-control'] ) }}
						<div class="input-group-append" >
							<span class="input-group-text">
							%
							</span>
						</div>
						
					</div>
					
				</div>

				<div class="col-12 col-sm-4">
					<div class="form-group">
						<label> Fondos D.
						</label>
						<div class="input-group mb-3">
							{{ Form::number('deuda'  , old('deuda') ,  ['required' => true,'class' => 'form-control'] ) }}
							<div class="input-group-append" >
								<span class="input-group-text">
								%
								</span>
							</div>
						</div>
						
					</div>
					
				</div>

				<div class="col-12 col-sm-4">
					<div class="form-group">
						<label> Comisión
						</label>
						<div class="input-group mb-3">
							{{ Form::number('comision'  , old('comision') ,  ['required' => true,'class' => 'form-control'] ) }}
							
						</div>
						
					</div>
					
				</div>


		</div>



			@if($type == 'edit')

			<div class="row">
			

				<div class="col-12 col-sm-6">
					{{ Form::bsInput('created_at' ,'text' , [ 
						'label' =>'Creación',
						'value' =>old('created_at'),
						'attr' =>[
							'required' =>true,
							'disabled' => true
						]   
						]) }}
				</div>

				<div class="col-12 col-sm-6">
					{{ Form::bsInput('updated_at' ,'text' , [ 
						'label' =>'Ultima Modificación',
						'value' =>old('updated_at'),
						'attr' =>[
							'required' =>true,
							'disabled' => true
						]   
						]) }}
				</div>

			</div>
			@endif
	
