@extends('ajtarragona-web-components::layout/master')

@section('title')
	@lang('Error Accede')
@endsection


@section('body')

	@container(['fluid'=>false,'class'=>'pt-5'])
		@alert(['type'=>'danger'])
			{!! $error !!}
		@endalert
	@endcontainer
	

@endsection

