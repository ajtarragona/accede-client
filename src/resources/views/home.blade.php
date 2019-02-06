@extends('accede-client::master')

@section('title')
	@lang('Accede Home')
@endsection

@section('body')

<div class="vialer-container">
	@row
		@col
			{{-- @dump($paisos) --}}
			Pais
			<select class="custom-select field_pais" >
				{{-- <option value="{{ $currentPais->codigoPais }}">{{ $currentPais->nombrePais }}</option>
				<option disabled>──────────</option>

				@foreach($paisos as $pais)
					<option value="{{ $pais->codigoPais }}">{{ $pais->nombrePais }}</option>
				@endforeach --}}
			</select>
		@endcol

		@col
			Provincia
			<select class="custom-select field_provincia">
				{{-- <option value="{{ $currentProvincia->codigoProvincia }}">{{ $currentProvincia->nombreProvincia }}</option>
				<option disabled>──────────</option>
				@foreach($provincies as $provincia)
					<option value="{{ $provincia->codigoProvincia }}">{{ $provincia->nombreProvincia }}</option>
				@endforeach --}}
			</select>
		@endcol

		@col
			Municipi
			<select class="custom-select field_municipi" >
				{{-- <option value="{{ $currentMunicipi->codigoMunicipio }}">{{ $currentMunicipi->nombreMunicipio }}</option>
				<option disabled>──────────</option>
				@foreach($municipis as $municipi)
					<option value="{{ $municipi->codigoMunicipio }}">{{ $municipi->nombreMunicipio }}</option>
				@endforeach --}}
			</select>
		@endcol
	@endrow
</div>

@endsection



@section('js')
	<script>
		var al=function(msg){
			console.log(msg);
		}

		//var 
		$.fn.startLoading = function(){
			return this.addClass('loading').css({"opacity":.5});
		}

		$.fn.stopLoading = function(){
			return this.removeClass('loading').css({"opacity":1});
		}



		$.fn.initVialerField = function(){
		    return this.each(function(){
		         al('initVialerField');
		         var o=this;

				 o.$container=$(o);
				 o.$paises=$(o).find('.field_pais');
				 o.$provincies=$(o).find('.field_provincia');
				 o.$municipis=$(o).find('.field_municipi');


		         o.refreshPaisos = function(){
		         	o.$paises.startLoading();
		         	var url= laroute.route('accede.paisos');
		         	al(url);
		         	$.getJSON(url,function(data){
		         		o.$paises.empty();
		         		$.each(data,function(i){
		         			o.$paises.append($('<option value="'+this.codigoPais+'">'+this.nombrePais+'</option>'));
		         		});
		         		
		         	}).fail(function() {
					    o.$paises.empty();
					}).always(function() {
					   o.$paises.stopLoading();
					});
		         }

		         o.refreshProvincies = function(){
		         	o.$provincies.startLoading();
		         	var url= laroute.route('accede.provincies');
		         	
		         	$.getJSON(url,function(data){
		         		o.$provincies.empty();
		         		$.each(data,function(i){
		         			o.$provincies.append($('<option value="'+this.codigoProvincia+'">'+this.nombreProvincia+'</option>'));
		         		});
		         		o.refreshMunicipis(o.$provincies.val());
		         	}).fail(function() {
					    o.$provincies.empty();
					}).always(function() {
					   o.$provincies.stopLoading();
					});
		         }


		          o.refreshMunicipis = function(codigoProvincia){
		         	o.$municipis.startLoading();
		         	var url= laroute.route('accede.municipis',{codigoProvincia:codigoProvincia});
		         	al('refreshMunicipis:'+url);
		         	$.getJSON(url,function(data){
		         		o.$municipis.empty();
		         		$.each(data,function(i){
		         			o.$municipis.append($('<option value="'+this.codigoMunicipio+'">'+this.nombreMunicipio+'</option>'));
		         		});
		         	}).fail(function() {
					    o.$municipis.empty();
					}).always(function() {
					   o.$municipis.stopLoading();
					});
		         }

		         o.init = function(){
		         	o.refreshPaisos();
		         	o.refreshProvincies();

		         	o.$provincies.on('change',function(){
		         		o.refreshMunicipis($(this).val());
		         	});
		         }

		         o.init();
		    })
		}



		$(document).ready(function(){
			$(".vialer-container").initVialerField();

		});
	</script>
@endsection
