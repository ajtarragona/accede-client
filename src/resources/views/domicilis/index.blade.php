@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Domicilis')
@endsection


@section('breadcrumb')
    @breadcrumb([
    	'items'=> [
    		['name'=>__("Domicilis")]
    	]
    ])
	
@endsection

@section('menu')
   @include('accede-client::menu')
@endsection

@section('actions')
    <a href="{{ route('accede.domicili.create.modal') }}" class="btn btn-secondary btn-sm tgn-modal-opener" data-size="lg">@icon('plus') Nou domicili</a>
@endsection

@section('body')

	@row
		@col(['size'=>3])
			{{-- @dump($domicilisfilter) --}}

			@form(['method'=>'POST','action'=>route('accede.domicili.dosearch')])
				{{-- @dump($domicilisfilter) --}}
				@include('accede-client::domicilis._fields',["domicili"=>$domicilisfilter,"readonly"=>false,"small"=>true])
				

				@button(['type'=>'submit','size'=>'sm']) @icon('search') Buscar @endbutton

			@endform
			@endcol
		@col(['size'=>9])
			@include('accede-client::domicilis._searchresults')
		@endcol
	@endrow

		

@endsection


@section('style')
	<link href="{{ asset('vendor/ajtarragona/css/accede.css') }}" rel="stylesheet">
@endsection


@section('js')
	<script src="{{ asset('vendor/ajtarragona/js/accede.js')}}" language="JavaScript"></script>
@endsection
