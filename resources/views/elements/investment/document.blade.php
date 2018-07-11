{{ Form::model( $documento ,['route' => ['admin.users.edit.document' , $user ]  ,'files' => true] ) }}
<div class="panel panel-primary">


	<div class="panel-heading"> 
		<h5 class="panel-title">
			 Documento {{ $numero }} 
		</h5>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-12 col-sm-4">
				{{ Form::bsInput('id_type_document' ,'select' , [ 
					'label' =>'Tipo de Archivo',
					'value' =>old('id_type_document'),
					'list' =>$catTypeDocument,
					'empty_option'=> 'Seleccione tipo archivo ...',
					'attr' =>[
						'required' =>true,
						'readonly' => true
					]   
					]) }}
			</div>


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
		
		</div>
	</div>
</div>

{{ Form::close() }}
