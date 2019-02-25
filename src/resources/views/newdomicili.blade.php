@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Accede Home')
@endsection

@section('body')

@form(['method'=>'POST','action'=>route('accede.domicili.store')])
	
	@input([
		'label'=>'Carrer', 
		'name'=>'carrer',
		'class'=> 'field_carrer autocomplete form-control',
		'value' => '',
		'data' => [
			'multiple'=> false,
			'url' => route('accede.vies.combo',[$currentProvincia->codigoProvincia,$currentMunicipi->codigoMunicipio
			]),
			'value' => '',
			'savevalue' => true,
			'showvalue' => false,
		],
		'icon' => 'map-marker-alt'
	])

	@row(['class'=>'gap-sm'])	
		
			@col
				@input([
					"name"=>"numero",
					"required"=>false,
					'type'=>'text',
					'class' => 'field_numero number form-control',
					"label"=>"Numero",
				])
			@endcol
			@col
				@input([
					"name"=>"lletra",
					"required"=>false,
					'class' => 'field_lletra form-control',
					"label"=>"Lletra",
				])
			@endcol

			@col
				@select([
					"name"=>"bloc",
					"required"=>false,
					'class' => 'field_bloc ',
					"label"=>"Bloc",
					"options"=>$blocs,
					'data'=>['width'=>'100%','live-search'=>false,'show-deselector'=>true],
					
				])
			@endcol
			@col
				@select([
					"name"=>"escala",
					"required"=>false,
					'class' => 'field_escala',
					"label"=>"Escala",
					"options"=>$escales,
					'data'=>['width'=>'100%','live-search'=>false,'show-deselector'=>true],
					
				])
			@endcol
			

			@col
				@select([
					"name"=>"planta",
					"required"=>false,
					'class' => 'field_planta',
					"label"=>"Planta",
					"options"=>$plantes,
					'data'=>['width'=>'100%','live-search'=>false,'show-deselector'=>true],
					
				])
			@endcol
			@col
				@select([
					"name"=>"porta",
					"required"=>false,
					'class' => 'field_porta',
					"label"=>"Porta",
					"options"=>$portes,
					'data'=>['width'=>'100%','live-search'=>false,'show-deselector'=>true],
					
				])
			@endcol
			
			@col
				@input([
					"name"=>"km",
					"required"=>false,
					'class' => 'field_km form-control',
					"label"=>"Km.",
					"disabled" =>false,
				])
			@endcol


			@col
				@select([
					"name"=>"codipostal",
					"required"=>false,
					'class' => 'field_codipostal',
					"label"=>"Codi Postal",
					"options"=>$codispostals,
					'data'=>['width'=>'100%','live-search'=>false,'show-deselector'=>true],
					
				])
			@endcol
		@endrow

	

@endform
@endsection


@section('style')
	<link href="{{ asset('vendor/ajtarragona/css/accede.css') }}" rel="stylesheet">
@endsection


@section('js')
	<script src="{{ asset('vendor/ajtarragona/js/accede.js')}}" language="JavaScript"></script>
@endsection
