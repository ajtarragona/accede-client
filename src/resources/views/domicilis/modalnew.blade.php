@extends('ajtarragona-web-components::layout/modal')

@section('title')
	@lang('Accede: nou domicili')
@endsection

     

@section('body')

	
	@form(['method'=>'POST','action'=>route('accede.domicili.store')])

		@include('accede-client::domicilis._fields',["readonly"=>false])
		<hr/>
		<div class="text-right">
			@button(['type'=>'submit','size'=>'sm']) @icon('check') Crear domicili @endbutton
		</div>

	@endform
	
	
@endsection
