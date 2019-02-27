{{-- @dump($domicili)
@dump($plantes)
 --}}
 	@row(['class'=>'gap-xs'])
 		@col
			@select([
				'label'=>'Tipus document', 
				'name'=>'codigoTipoDocumento',
				'required' =>false,
				'options' => $tipusDocuments,
				'data'=>['width'=>'100%','live-search'=>false,'show-deselector'=>true],
				'selected' => $tercer->codigoTipoDocumento,
								
			])
		@endcol
		@col
			@input([
				'label'=>'Documento', 
				'name'=>'documento',
				'value' => $tercer->documento,
			])
		@endcol
	@endrow


	@row(['class'=>'gap-0'])	
		
			@col(['size'=>4])
				@input([
					'label'=>'Nombre', 
					'name'=>'nombre',
					'value' => $tercer->nombre,
				])
			@endcol
			
			@col(['size'=>1])
				@input([
					'label'=>'P1', 
					'name'=>'particula1',
					'value' => $tercer->particula1,
				])
			@endcol


			@col(['size'=>3])
				@input([
					'label'=>'Apellido 1', 
					'name'=>'apellido1',
					'value' => $tercer->apellido1,
				])
			@endcol
			

			@col(['size'=>1])
				@input([
					'label'=>'P2', 
					'name'=>'particula2',
					'value' => $tercer->particula2,
				])
			@endcol


			@col(['size'=>3])
				@input([
					'label'=>'Apellido 2', 
					'name'=>'apellido2',
					'value' => $tercer->apellido2,
				])
			@endcol

			
	@endrow

