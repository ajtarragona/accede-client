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


@row
	@col(['size'=>5])
		@form(['method'=>'POST','action'=>route('accede.tercer.save',[$tercer->codigoTercero])])
	
			@include('accede-client::tercers._fields',["readonly"=>true])
		
			@button(['type'=>'submit','size'=>'sm']) @icon('disk') Guardar @endbutton

		@endform
		
	@endcol


	@col(['size'=>7])
		@include('accede-client::tercers._domicilis',["domicilis"=>$tercer->getDomicilis()])

		    <a href="{{ route('accede.tercer.domicilis.addmodal',[$tercer->codigoTercero]) }}" class="btn btn-light btn-sm tgn-modal-opener" data-size="lg">@icon('plus') Afegir domicili</a>


	@endcol
@endrow

@endsection
