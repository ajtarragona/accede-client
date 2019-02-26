
		@if(isset($tercers) && $tercers)
			
			
			
			<table class="table table-striped table-sm mt-3">
				<thead>
					<th>Codi</th>
					<th>Tipus document</th>
					<th>Document</th>
					<th>Nombre</th>
					<th>Apellido1</th>
					<th>Apellido2</th>
					<th>Nombre completo</th>
					
				</thead>
				<tbody>
					@foreach($tercers as $tercer)
					{{-- @dump($tercer) --}}
						<tr>
							<td><a href="{{ route('accede.tercer.show',[$tercer->codigoTercero]) }}">{{ $tercer->codigoTercero }}</a></td>
							<td>{{ $tercer->nombreTipoDocumento }}</td>
							<td>{{ $tercer->documento }}</td>
							<td>{{ $tercer->nombre }}</td>
							<td>{{ $tercer->apellido1 }}</td>
							<td>{{ $tercer->apellido2 }}</td>
							<td>{{ $tercer->nombreCompleto() }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
