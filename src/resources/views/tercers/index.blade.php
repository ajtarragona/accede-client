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

			@include('accede-client::tercers._filterfields')
				
				<hr/>
				<h3>Autocomplete</h3>

			@input([
				'label'=>'Tercer', 
				'name'=>'codigoTercero',
				'class'=> 'field_tercer autocomplete form-control',
				'value' => '',
				'data' => [
					'multiple'=> false,
					'url' => route('accede.tercers.combo'),
					'value' => '',
					'savevalue' => true,
					'showvalue' => false,
					'min-length' => 3
				],
				'icon' => 'user'
			])

		@endcol
		@col(['size'=>9])
			@include('accede-client::tercers._searchresults')
		@endcol
	@endrow

		

@endsection

