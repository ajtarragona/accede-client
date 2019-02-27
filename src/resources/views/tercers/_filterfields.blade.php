@form(['method'=>'POST','action'=>route('accede.tercer.dosearch')])
	<h3>Per document</h3>	


	@row(['class'=>'gap-xs'])
		@col
			@select([
				'label'=>'Tipus document', 
				'name'=>'codigoTipoDocumento',
				'required' =>false,
				'options' => $tipusDocuments,
				'data'=>['width'=>'100%','live-search'=>false,'show-deselector'=>true],
				'selected' => $tercersfilter->codigoTipoDocumento,
								
			])
		@endcol
		@col
			@input([
				'label'=>'Document', 
				'name'=>'documento',
				'value' => $tercersfilter->documento,
			])

		@endcol
	@endrow

	@button(['type'=>'submit','size'=>'sm']) @icon('search') Buscar @endbutton

@endform

<hr/>

@form(['method'=>'POST','action'=>route('accede.tercer.dosearch')])
	<h3>Per nom o cognoms</h3>	



	@input([
		'label'=>'Nom o cognoms', 
		'name'=>'busqueda',
		'value' => $tercersfilter->busqueda,
	])

	@button(['type'=>'submit','size'=>'sm']) @icon('search') Buscar @endbutton

@endform

