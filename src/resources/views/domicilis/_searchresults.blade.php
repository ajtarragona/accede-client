
		@if(isset($domicilis) && $domicilis)
			
			
			
			<table class="table table-striped table-sm mt-3">
				<thead>
					<th>Codi</th>
					<th>Tipus via</th>
					<th>Carrer</th>
					<th>Numero</th>
					{{-- <th>Numeració</th> --}}
					<th>Lletra</th>
					<th>Bloc</th>
					<th>Escala</th>
					<th>Planta</th>
					<th>Porta</th>
					<th>Codi postal</th>
					<th>Cadena</th>
				</thead>
				<tbody>
					@foreach($domicilis as $domicili)
						<tr>
							<td><a href="{{ route('accede.domicili.show',[$domicili->codigoDomicilio]) }}">{{ $domicili->codigoDomicilio }}</a></td>
							<td>{{ $domicili->codigoTipoVia }}</td>
							<td>{{-- <span class="badge">{{ $domicili->codigoIneVia }}</span>  --}}{{ $domicili->nombreVia }}</td>
							<td>{{ $domicili->getNumero() }}</td>
							{{-- <td>{{ $domicili->codigoTipoNumeracion }} {{ $domicili->nombreTipoNumeracion }}</td> --}}
							<td>{{ $domicili->getLletra() }}</td>
							<td>{{ $domicili->codigoBloque }}</td>
							<td>{{ $domicili->codigoEscalera }}</td>
							<td>{{ $domicili->nombrePlanta }}</td>
							<td>{{ $domicili->codigoPuerta }}</td>
							<td>{{ $domicili->codigoPostal }}</td>
							<td>{{ $domicili->cadenaDomicilioCompleta }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
