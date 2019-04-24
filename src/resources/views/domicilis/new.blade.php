@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Accede: nou domicili')
@endsection



@section('breadcrumb')

    @breadcrumb([
    	'items'=> [
    		['name'=>__("Domicilis"), "url"=>route('accede.domicili.search')],
    		['name'=> "Nou domicili"]
    	]

    ])
	
@endsection
            

@section('body')
	<div class="pt-3">

		@row
			@col(['size'=>3])
				@include('accede-client::menu')
			@endcol


			@col(['size'=>9])
			
				@form(['method'=>'POST','action'=>route('accede.domicili.store')])
			
					@include('accede-client::domicilis._fields',["readonly"=>false])
				
					@button(['type'=>'submit','size'=>'sm']) @icon('check') Crear @endbutton

				@endform
				
			@endcol
		@endrow
	</div>
@endsection


@section('style')
	<link href="{{ asset('vendor/ajtarragona/css/accede.css') }}" rel="stylesheet">
@endsection


@section('js')
	<script src="{{ asset('vendor/ajtarragona/js/accede.js')}}" language="JavaScript"></script>
@endsection
