@extends('ajtarragona-web-components::layout/master')

@section('title')
	@lang('Accede Home')
@endsection

@section('body')

@row
	@col(['size'=>3])
		@include('accede-client::menu')
	@endcol


	@col(['size'=>9])
	
		@form(['method'=>'POST','action'=>route('accede.home')])
			<div 
				class="vialer-container" 
				data-current-pais="{{ $currentPais->codigoPais }}" 
				data-current-provincia="{{ $currentProvincia->codigoProvincia }}" 
				data-current-municipi="{{ $currentMunicipi->codigoMunicipio }}"
			>
				@row(['class'=>'gap-sm'])
					@col
						{{-- @dump($paisos) --}}
						
						@select([
								"name"=>"pais",
								"required"=>false,
								'class' => 'field_pais',
								"label"=>"Pais",
								"options"=>[],
								'data'=>['width'=>'100%','live-search'=>true],
								
							])
						
					@endcol

					@col
						@select([
								"name"=>"provincia",
								"required"=>false,
								'class' => 'field_provincia',
								"label"=>"Provincia",
								"options"=>[],
								'disabled'=>true,
								'data'=>['width'=>'100%','live-search'=>true],
								
							])
						
					@endcol

					@col
						@select([
								"name"=>"municipi",
								"required"=>false,
								'class' => 'field_municipi',
								"label"=>"Municipi",
								"options"=>[],
								'disabled'=>true,
								'data'=>['width'=>'100%','live-search'=>true],
								
							])
						
					@endcol
				@endrow

				<div class="adreca_codificada">
					@row(['class'=>'gap-sm'])
						@col
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

							
						@endcol
					@endrow

					@row(['class'=>'gap-sm'])
						@col
							@select([
								"name"=>"numero",
								"required"=>false,
								'class' => 'field_numero',
								"label"=>"Numero",
								"disabled" =>true,
								"options"=>[],
								'data'=>['width'=>'100%','live-search'=>true],
								
							])
						@endcol

						@col
							@select([
								"name"=>"escala",
								"required"=>false,
								'class' => 'field_escala',
								"label"=>"Escala",
								"disabled" =>true,
								"options"=>[],
								'data'=>['width'=>'100%','live-search'=>false],
								
							])
						@endcol

						@col
							@select([
								"name"=>"planta",
								"required"=>false,
								'class' => 'field_planta',
								"label"=>"Planta",
								"disabled" =>true,
								"options"=>[],
								'data'=>['width'=>'100%','live-search'=>false],
								
							])
						@endcol
						@col
							@select([
								"name"=>"porta",
								"required"=>false,
								'class' => 'field_porta',
								"label"=>"Porta",
								"disabled" =>true,
								"options"=>[],
								'data'=>['width'=>'100%','live-search'=>false],
								
							])
						@endcol


						@col
							@select([
								"name"=>"codipostal",
								"required"=>false,
								'class' => 'field_codipostal',
								"label"=>"Codi Postal",
								"disabled" =>true,
								"options"=>[],
								'data'=>['width'=>'100%','live-search'=>false],
								
							])
						@endcol
					@endrow
				</div>
				<div class="adreca_lliure">
					@input([
						'label'=>'Adreça', 
						'name'=>'adreca_lliure',
						'class'=> 'field_adreca form-control',
						'value' => '',
						'icon' => 'map-marker-alt'
					])
				</div>
			</div>
		@endform

	@endcol
@endrow

@endsection



@section('js')
	<script>
		// var al=function(msg){
		// 	console.log(msg);
		// }

		//var 
		$.fn.enableSelect = function(){
			this.prop('disabled',false);
			this.closest('.form-group').removeClass("disabled");
			this.selectpicker('refresh');
	         		
			return this;

		}

		$.fn.disableSelect = function(){
			this.prop('disabled',true);
			this.closest('.form-group').addClass("disabled");
			this.selectpicker('refresh');
	        return this;
		}



		$.fn.initVialerField = function(){
		    return this.each(function(){
		         al('initVialerField');
		         var o=this;
		         o.currentPais=$(this).data("current-pais");
		         o.currentProvincia=$(this).data("current-provincia");
		         o.currentMunicipi=$(this).data("current-municipi");
		        // al(o.currentPais);

				 o.$container=$(o);
				 o.$paises=$(o).find('select.field_pais');
				 o.$provincies=$(o).find('select.field_provincia');
				 o.$municipis=$(o).find('select.field_municipi');
				 o.$carrer=$(o).find('.field_carrer');
				 o.$numeros=$(o).find('select.field_numero');
				 o.$escales=$(o).find('select.field_escala');
				 o.$plantes=$(o).find('select.field_planta');
				 o.$portes=$(o).find('select.field_porta');
				 o.$codispostals=$(o).find('select.field_codipostal');

//al(o.$numeros);
		         o.refreshPaisos = function(){
		         	al("refreshPaisos");
					o.$paises.closest(".form-group").startLoading();
					//al(o.$paises);
		         	var url= laroute.route('accede.paisos');
		         	//al(url);
		         	$.getJSON(url,function(data){
		         		o.$paises.empty();
		         		$.each(data,function(i){
		         			o.$paises.append($('<option value="'+this.codigoPais+'">'+this.nombrePais+'</option>'));
		         		});

		         		o.$paises.enableSelect();
		         		o.$paises.selectpicker('val', o.currentPais);
		         		
		         	}).fail(function() {
					    o.$paises.empty().disableSelect();

					}).always(function() {

					   o.$paises.closest(".form-group").stopLoading();

					});
		         }

		         o.refreshProvincies = function(){
		         	al("refreshProvincies");
		         	// al(o.$paises.val());
		         	// al(o.currentPais);
		         	if(o.$paises.val()==o.currentPais){
		         		//al("SI");
			         	o.$provincies.closest(".form-group").startLoading();
			         	var url= laroute.route('accede.provincies');
			         	
			         	$.getJSON(url,function(data){
			         		o.$provincies.empty();
			         		$.each(data,function(i){
			         			o.$provincies.append($('<option value="'+this.codigoProvincia+'">'+this.nombreProvincia+'</option>'));
			         		});


			         		o.$provincies.enableSelect();
			         		o.$provincies.selectpicker('val', o.currentProvincia);
			         		o.refreshMunicipis(o.$provincies.val());

			         	}).fail(function() {
						    o.$provincies.empty().disableSelect();
						}).always(function() {
						   o.$provincies.closest(".form-group").stopLoading();
						});
		         	}else{
		         		//al("NO");
		         		o.$provincies.empty().prop('disabled',true);
			         	o.$provincies.selectpicker('refresh');
						o.$provincies.closest('.form-group').addClass("disabled");
						o.$provincies.closest(".form-group").stopLoading();

						o.$municipis.empty().prop('disabled',true);
			         	o.$municipis.selectpicker('refresh');
						o.$municipis.closest('.form-group').addClass("disabled");
						o.$municipis.closest(".form-group").stopLoading();

						o.toggleAdreca(false);
		         	}
		         }



		          o.refreshMunicipis = function(codigoProvincia){
		         	if(codigoProvincia){
		         		o.$municipis.closest(".form-group").startLoading();

			         	var url= laroute.route('accede.municipis',{codigoProvincia:codigoProvincia});
			         	al('refreshMunicipis:'+url);

			         	$.getJSON(url,function(data){
			         		o.$municipis.empty();
			         		$.each(data,function(i){
			         			o.$municipis.append($('<option value="'+this.codigoMunicipio+'">'+this.nombreMunicipio+'</option>'));
			         		});
			         		o.$municipis.enableSelect();
			         		if(o.$provincies.val()==o.currentProvincia){
			         			o.$municipis.selectpicker('val', o.currentMunicipi);
			         		}
			         		o.$municipis.trigger('change');
			         		
			         		
			         	}).fail(function() {
						    
						    o.$municipis.disableSelect();

						}).always(function() {
						   //al("OK");
						   //al(o.$municipis);
						   o.$municipis.closest(".form-group").stopLoading();
						});
					}else{
						o.$municipis.disableSelect();
						o.$municipis.closest(".form-group").stopLoading();
					}
		         }

		         o.refreshNumeros = function(codigoIneVia){
		         	if(codigoIneVia){
		         		o.$numeros.closest(".form-group").startLoading();

			         	var url= laroute.route('accede.numeros',{codigoIneVia:codigoIneVia});
			         	al('refreshNumeros:'+url);

			         	$.getJSON(url,function(data){
			         		o.$numeros.empty();
			         		if(data && data.length>0){
				         		$.each(data,function(i){
				         			o.$numeros.append($('<option value="'+this+'">'+this+'</option>'));
				         		});
				         		o.$numeros.enableSelect();
				         		o.$numeros.selectpicker('val', data[0]);
				         	}else{
				         		o.$numeros.disableSelect();
				         	}
			         	}).fail(function() {
						    o.$numeros.disableSelect();
						}).always(function() {
						   o.$numeros.closest(".form-group").stopLoading();
						   //o.$numeros.trigger('change');
						});

		         	}else{
		         		o.$numeros.empty();
			         	o.$numeros.disableSelect();
		         	}
		         }


				o.refreshEscales = function(codigoIneVia, numero){
					

		         	if(codigoIneVia && numero ){
		         		o.$escales.closest(".form-group").startLoading();

			         	var url= laroute.route('accede.escales',{codigoIneVia:codigoIneVia,numero:numero});
			         	al('refreshEscales:'+url);

			         	$.getJSON(url,function(data){
			         		
			         		o.$escales.empty();
			         		if(data && data.length>0){
				         		$.each(data,function(i){
				         			o.$escales.append($('<option value="'+this.codigoEscalera+'">'+this.nombreEscalera+'</option>'));
				         		});
				         		o.$escales.enableSelect();
				         		o.$escales.selectpicker('val', data[0].codigoEscalera);
				         	}else{
				         		o.$escales.disableSelect();
				         	}
			         	}).fail(function() {
						    o.$escales.disableSelect();
						}).always(function() {
						   o.$escales.closest(".form-group").stopLoading();
						});

		         	}else{
		         		o.$escales.empty();
			         	o.$escales.disableSelect();
		         	}
		         }


		         o.refreshPlantes = function(codigoIneVia, numero){
					

		         	if(codigoIneVia && numero ){
		         		o.$plantes.closest(".form-group").startLoading();

			         	var url= laroute.route('accede.plantes',{codigoIneVia:codigoIneVia,numero:numero});
			         	al('refreshPlantes:'+url);

			         	$.getJSON(url,function(data){
			         		
			         		o.$plantes.empty();
			         		if(data && data.length>0){
				         		$.each(data,function(i){
				         			o.$plantes.append($('<option value="'+this.codigoPlanta+'">'+this.nombrePlanta+'</option>'));
				         		});
				         		o.$plantes.enableSelect();
				         		o.$plantes.selectpicker('val', data[0].codigoPlanta);
				         	}else{
				         		o.$plantes.disableSelect();
				         	}
			         	}).fail(function() {
						    o.$plantes.disableSelect();
						}).always(function() {
						   o.$plantes.closest(".form-group").stopLoading();
						});

		         	}else{
		         		o.$plantes.empty();
			         	o.$plantes.disableSelect();
		         	}
		         }


 				o.refreshPortes = function(codigoIneVia, numero, planta){
					

		         	if(codigoIneVia && numero && planta ){
		         		o.$portes.closest(".form-group").startLoading();

			         	var url= laroute.route('accede.portes',{codigoIneVia:codigoIneVia,numero:numero});
			         	al('refreshPortes:'+url);

			         	$.getJSON(url,function(data){
			         		
			         		o.$portes.empty();
			         		if(data && data.length>0){
				         		$.each(data,function(i){
				         			o.$portes.append($('<option value="'+this.codigoPuerta+'">'+this.nombrePuerta+'</option>'));
				         		});
				         		o.$portes.enableSelect();
				         		o.$portes.selectpicker('val', data[0].codigoPuerta);
				         	}else{
				         		o.$portes.disableSelect();
				         	}
			         	}).fail(function() {
						    o.$portes.disableSelect();
						}).always(function() {
						   o.$portes.closest(".form-group").stopLoading();
						});

		         	}else{
		         		o.$portes.empty();
			         	o.$portes.disableSelect();
		         	}
		         }


		         o.refreshCodispostals = function(codigoIneVia, numero){
					

		         	if(codigoIneVia && numero ){
		         		o.$codispostals.closest(".form-group").startLoading();

			         	var url= laroute.route('accede.codispostals',{codigoIneVia:codigoIneVia,numero:numero});
			         	al('refreshcodispostals:'+url);

			         	$.getJSON(url,function(data){
			         		
			         		o.$codispostals.empty();
			         		if(data && data.length>0){
				         		$.each(data,function(i){
				         			o.$codispostals.append($('<option value="'+this+'">'+this+'</option>'));
				         		});
				         		o.$codispostals.enableSelect();
				         		o.$codispostals.selectpicker('val', data[0]);
				         	}else{
				         		o.$codispostals.disableSelect();
				         	}
			         	}).fail(function() {
						    o.$codispostals.disableSelect();
						}).always(function() {
						   o.$codispostals.closest(".form-group").stopLoading();
						});

		         	}else{
		         		o.$codispostals.empty();
			         	o.$codispostals.disableSelect();
		         	}
		         }

		         o.toggleAdreca = function(codigoMunicipio){
		          	al('toggleAdreca');
		          	if(codigoMunicipio == o.currentMunicipi){
		          		$('.adreca_lliure').hide();
		          		$('.adreca_codificada').show();
		          	}else{
		          		$('.adreca_lliure').show();
		          		$('.adreca_codificada').hide();
		          	}
		         }


		         o.init = function(){
		         	o.refreshPaisos();
		         	//o.toggleAdreca(false);

		         	o.$paises.on('change',function(){
		         		o.refreshProvincies();
		         	});


		         	o.$provincies.on('change',function(){
		         		o.refreshMunicipis($(this).val());
		         	});


		         	o.$municipis.on('change',function(){
		         		o.toggleAdreca($(this).val());
		         	});

		         	
					o.$carrer.bind('typeahead:select', function(ev, suggestion) {
						o.refreshNumeros(suggestion.value);
						o.refreshEscales();
						o.refreshPlantes();
						o.refreshPortes();
						o.refreshCodispostals();
		            });

					o.$numeros.on('change', function() {
						al("numeros change");
						var carrerval=o.$carrer.closest('.form-group').find('input[type=hidden]').val();
						var numero=$(this).val();
						al(carrerval + "-"+numero);
						o.refreshEscales(carrerval,numero);
						o.refreshPlantes(carrerval,numero);
						o.refreshCodispostals(carrerval,numero);
						o.refreshPortes();

		            });

		            o.$plantes.on('change', function() {
						var carrerval= o.$carrer.closest('.form-group').find('input[type=hidden]').val();
						//al(o.$numero);
						var numero= o.$numeros.val();
						var planta= $(this).val();
						o.refreshPortes(carrerval,numero,planta);

		            });

		           
		         }

		         o.init();
		    })
		}



		$(window).on('load',function(){
			$(".vialer-container").initVialerField();

		});
	</script>
@endsection
