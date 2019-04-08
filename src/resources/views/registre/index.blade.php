@extends('ajtarragona-web-components::layout/master-sidebar')

@section('title')
	@lang('Accede Registre')
@endsection

@section('menu')
   @include('accede-client::menu')
@endsection


@section('breadcrumb')
    @breadcrumb([
    	'items'=> [
    		['name'=>__("Registre")]
    	]
    ])
	
@endsection

@section('body')
@row
	


	@col(['size'=>3])

		@form([
			"action"=>route('accede.register.dosearch'),
			"method" =>"post"

		])	
		{{-- @dump($registerfilter) --}}

			@select([
				"name"=>"es",
				"required"=>false,
				"label"=>"E/S",
				"options"=>["E"=>"Entrada","S"=>"Sortida"],
				'data'=>['width'=>'100%'],
				'selected' => $registerfilter->es
			])

			@input(["name"=>"eje","label"=>"Ejercicio",'value' =>  $registerfilter->eje ])
			@input(["name"=>"numero","label"=>"Número",'value' =>  $registerfilter->numero ,"helptext"=>"Numero individual, varios separats per comes o un rang separat per un guió"])

			@input(["name"=>"documento","label"=>"DNI",'value' =>  $registerfilter->documento ])

			@button(["type"=>"submit",'size'=>'sm']) @icon("search") Buscar  @endbutton

		@endform				
	@endcol

	@col(['size'=>9])
		@if($registres)
			<table class="table">
				<thead>
					<tr>
						<th>Numero</th>
						<th>Ejercicio</th>
						<th>Fecha</th>
						<th>Explicacion</th>
						<th>Interesado</th>
						<th>Departament</th>
						<th>Estat</th>
				</thead>
				<tbody>
					@foreach($registres as $anotacion)
						
						<tr>
							<td class="text-nowrap">{{ $anotacion->getMatricula() }}</td>
							<td>{{ $anotacion->eje }}</td>
							<td>{{ $anotacion->fecha }}</td>
							<td>{{ $anotacion->explicacion }}</td>
							<td>
								{{-- @dump($anotacion->getInteresados()) --}}
								@if($interesados=$anotacion->getInteresados())
									@foreach($interesados as $interesado)
										<p>
											{{ $interesado->documento }} | 
											{{ $interesado->nombre }} {{ $interesado->apellido1 }} {{ $interesado->apellido2 }} | 
											{{ $interesado->direccion }}
										</p>
									@endforeach
								@endif
							</td>
							<td>
								@if($anotacion->deEntrada())
									{{-- @dump($anotacion->l_destino) --}}
									@if($anotacion->l_destino)
										@foreach($anotacion->l_destino as $destino)
											@if(is_array($destino)) 
												{{ isset($destino["nombre_destino"])?$destino["nombre_destino"]:(isset($destino["codigo_destino"])?$destino["codigo_destino"]:'-') }} 
											@endif
										@endforeach
									@endif
								@else
									{{-- @dump($anotacion->l_origen) --}}
									@if($anotacion->l_origen)
										@foreach($anotacion->l_origen as $origen)
											@if(is_array($origen))  
												{{ isset($origen["nombre_origen"])?$origen["nombre_origen"]:(isset($origen["codigo_origen"])?$origen["codigo_origen"]:'-') }} 
											@endif
										@endforeach
									@endif
								@endif
							</td>
							<td>{{ $anotacion->estado_anotacion }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		@endif
	@endcol
	
@endrow
@endsection