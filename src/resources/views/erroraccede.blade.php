@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Error Accede')
@endsection

@section('menu')
   @include('accede-client::menu')
@endsection

@section('body')

		@alert(['type'=>'danger'])
			{{ $error }}
		@endalert


@endsection

