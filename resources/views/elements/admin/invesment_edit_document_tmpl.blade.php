{{ Form::bsInput('id' ,'hidden' ) }}
{{ Form::bsInput('id_user' ,'hidden', ['value' => $user->id]) }}
{{ Form::bsInput('id_contract' ,'hidden', ['value' => $contrato->id]) }}
{{ Form::bsInput('count' ,'hidden', ['value' => $count]) }}

<div class="card mt-3">

	<div class="card-header"> 
	 Documento {{ $count }} 
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-4">
				{{ Form::bsInput('id_type_document' ,'select' , [ 
					'label' =>'Tipo de Archivo',
					'value' =>old('id_type_document'),
					'list' =>$catTypeDocument,
					'empty_option'=> 'Seleccione tipo archivo ...',
					'attr' =>[
						'required' =>true,
						'readonly' => $type ==='edit' 
					]   
					]) }}
			</div>

			@if ($type=='register')
				<div class="col-12 col-sm-6">
					{{ Form::bsInput('file' ,'file' , [ 
						'label' =>'Archivo',
						'attr' =>[
							'required' =>true
						]   
						]) }}
				</div>
			@else 

			<div class="col-12 col-sm-6">
				<label> Nombre de Archivo</label>
				<div class="input-group ">
					 {{ Form::text('name',null  , [ 
					 			'required' =>true,
								'readonly'=> true,
								'class' => 'form-control'
						]) }}
					  <div class="input-group-append">
					    <button class="btn btn-success view-document"  
					    data-type="{{ $documento->extension->name }}" 
					    data-url="{{ route("admin.users.view.document",[ "id"=> $documento->id ] ) }}"
					    data-title="{{ $documento->name }}" > Ver </button>
					    <button class="btn btn-info download-document " data-url="{{ route("admin.users.download.document",[ "id"=> $documento->id ] ) }} " > Descargar </button>
					  </div>
				</div>
			</div>
					
			@endif
		
		
		</div>
	</div>

	

</div>
