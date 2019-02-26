{{-- @dump($domicili)
@dump($plantes)
 --}}


	@input([
		'label'=>'Documento', 
		'name'=>'documento',
		'value' => $tercer->documento,
	])

	

	@row(['class'=>'gap-xs'])	
		
			@col
				@input([
					'label'=>'Nombre', 
					'name'=>'nombre',
					'value' => $tercer->nombre,
				])
			@endcol
			
			@col
				@input([
					'label'=>'Partícula1', 
					'name'=>'particula1',
					'value' => $tercer->particula1,
				])
			@endcol


			@col
				@input([
					'label'=>'Apellido1', 
					'name'=>'Apellido1',
					'value' => $tercer->apellido1,
				])
			@endcol
			

			@col
				@input([
					'label'=>'Partícula2', 
					'name'=>'particula2',
					'value' => $tercer->particula2,
				])
			@endcol


			@col
				@input([
					'label'=>'Apellido2', 
					'name'=>'Apellido2',
					'value' => $tercer->apellido2,
				])
			@endcol

			
	@endrow

