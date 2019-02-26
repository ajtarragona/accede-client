@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Tercers')
@endsection


@section('breadcrumb')
    @breadcrumb([
    	'items'=> [
    		['name'=>__("Tercers")]
    	]
    ])
	
@endsection

@section('menu')
   @include('accede-client::menu')
@endsection

@section('actions')
    <a href="{{ route('accede.tercer.create.modal') }}" class="btn btn-secondary btn-sm tgn-modal-opener" data-size="lg">@icon('plus') Nou tercer</a>
@endsection

@section('body')

	@row
		@col(['size'=>3])
			{{-- @dump($domicilisfilter) --}}

			@form(['method'=>'POST','action'=>route('accede.tercer.dosearch')])
				{{-- @dump($domicilisfilter) --}}
				@include('accede-client::tercers._filterfields')
				

				@button(['type'=>'submit','size'=>'sm']) @icon('search') Buscar @endbutton

			@endform
		@endcol
		@col(['size'=>9])
			@include('accede-client::tercers._searchresults')
		@endcol
	@endrow

		

@endsection

