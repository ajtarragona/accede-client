@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Accede: Tercer')
@endsection


@section('breadcrumb')

    @breadcrumb([
    	'items'=> [
    		['name'=>__("Tercers"), "url"=>route('accede.tercer.search')],
    		['name'=> "Tercer ".$tercer->codigoTercero]
    	]

    ])
	
@endsection
            

@section('menu')
   @include('accede-client::menu')
@endsection

@section('body')



	
		@include('accede-client::tercers._fields',["readonly"=>true])
		
	

@endsection
