
		@if(isset($domicilis) && $domicilis)
			
			
			
			<table class="table table-striped table-sm mt-3">
				<thead>
					<th>Ppal?</th>
					
					<th>Domicili</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($domicilis as $domicili)
						<tr>
							<td>{!! $domicili->esPrincipal()?circleicon('check',['bg-color'=>'info','color'=>'white','size'=>'sm']):"" !!}</td>
							<td>{{ $domicili->cadenaDomicilioCompleta }}</td>
							<td>

								@form([
									'method'=>'POST',
									'action'=>route('accede.tercer.domicilis.update',[$tercer->codigoTercero,$domicili->codigoDomicilio]),
									'data'=>['confirm'=>'Segur?']
								])
					

									@button(['type'=>'submit','size'=>'xs','class'=>'btn-light','name'=>'submitaction','value'=>'setprincipal','disabled'=>$domicili->esPrincipal()]) @icon('check') Fer principal @endbutton

									@button(['type'=>'submit','size'=>'xs','class'=>'btn-danger','name'=>'submitaction','value'=>'remove']) @icon('times') @endbutton

								@endform
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
