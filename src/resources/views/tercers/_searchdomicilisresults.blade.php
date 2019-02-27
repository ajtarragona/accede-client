		@if(isset($domicilis) && $domicilis)
			
			@form(['method'=>'POST','action'=>route('accede.tercer.domicilis.assign',[$tercer->codigoTercero])])

				
				<table class="table table-striped  mt-3 table-response table-selectable table-hover">
					<thead>
						<th size="20">&nbsp;</th>
						<th>Carrer</th>
					</thead>
					<tbody>
						@foreach($domicilis as $domicili)
							<tr>
								<td>
									@checkbox(['name'=>'codigoDomicilio[]','value'=>$domicili->codigoDomicilio,'renderhelper'=>false])
								</td>
								<td>{{ $domicili->cadenaDomicilioCompleta }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				<hr/>

				<div class="text-right">
					@button(['type'=>'submit','class'=>'btn-primary', 'size'=>'sm']) @icon('check') Afegir domicilis marcats @endbutton
				</div>

			@endform
		@endif
