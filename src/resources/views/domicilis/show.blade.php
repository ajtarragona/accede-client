@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Accede: Domicili')
@endsection


@section('breadcrumb')

    @breadcrumb([
    	'items'=> [
    		['name'=>__("Domicilis"), "url"=>route('accede.domicili.search')],
    		['name'=> "Domicili ".$domicili->codigoDomicilio]
    	]

    ])
	
@endsection
            

@section('menu')
   @include('accede-client::menu')
@endsection

@section('body')

	<div class="pt-3">
		@include('accede-client::domicilis._fields',["readonly"=>true])
	</div>	
	

@endsection


@section('style')
	<link href="{{ asset('vendor/ajtarragona/css/accede.css') }}" rel="stylesheet">
@endsection


@section('js')
	<script src="{{ asset('vendor/ajtarragona/js/accede.js')}}" language="JavaScript"></script>
@endsection
