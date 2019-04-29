@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('emergencia.update',$eme->getHashId()) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">Crear Emergencia</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="fecha">FECHA</label>
					<input type="date" id="fecha" name="fecha_emergencia" class="form-control"
					value ="{{ $eme->fecha_emergencia }}">
				</div>
				<div class="col-md-2">
					<label for="hora">HORA</label>
					<input type="time" id="hora" name="hora_emergencia" class="form-control" autocomplete="off"
					value="{{ $eme->hora_emergencia }}">
				</div>
				<div class="col-md-5">
					<label for="dire">DIRECCION</label>
					<input id="dire" name="direccion" class="form-control" autocomplete="off" 
					value="{{ $eme->direccion }}">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-3">
					<label for="clave">CLAVE</label>
					<select id="clave" name="clave_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($clave as $key => $value)
							@if($eme->clave_id== $key)
								<option  selected value="{{ $key }}"> {{ $value }}</option>
							@else
								<option value="{{ $key }}"> {{ $value }}</option>
							@endif	
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					<label for="comuna">COMUNA</label>
					<select id="comuna" name="comuna" class="form-control">
						<option value="">--Seleccione--</option>
						<option @if($eme->comuna=='IQUIQUE') selected @endif value="IQUIQUE">IQUIQUE</option>
						<option @if($eme->comuna=='ALTO HOSPICIO') selected @endif value="ALTO HOSPICIO">ALTO HOSPICIO</option>
						<option @if($eme->comuna=='CAMIÑA') selected @endif value="CAMIÑA">CAMIÑA</option>
						<option @if($eme->comuna=='COLCHANE') selected @endif value="COLCHANE">COLCHANE</option>
						<option @if($eme->comuna=='HUARA') selected @endif value="HUARA">HUARA</option>
						<option @if($eme->comuna=='PICA') selected @endif value="PICA">PICA</option>
						<option @if($eme->comuna=='POZO ALMONTE') selected @endif value="POZO ALMONTE">POZO ALMONTE</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="cias">COMPAÑIAS</label>
					<select id="cias" data-placeholder="Seleccione Compañias" name="cias[]" multiple 
					class=" form-control chosen-select">
						@foreach($cia as $key => $value)
						@php $control=false;  @endphp
							@if($key != 11)
								@foreach($eme->cias as $row)
									 @if($row->cia->id==$key)
									 	@php $control=true;  @endphp
									 @endif
								@endforeach
								<option @if($control) selected @endif  value="{{ $key }}"> {{ $value }}</option>
							@endif	
						@endforeach
					</select>
				</div>	
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="uni">UNIDADES</label>
					<select id="uni" data-placeholder="Seleccione Unidades" name="uni[]" multiple 
					class="form-control chosen-select">
						@foreach($veh as $row)
							@php $control=false;  @endphp
								@foreach($eme->unidades as $uni)
									 @if($uni->vehiculo_id==$row->id)
									 	@php $control=true;  @endphp
									 @endif
								@endforeach
								<option  @if($control) selected @endif value="{{ $row->id }}"> {{ $row->clave }}</option>
						@endforeach
					</select>
				</div>	
			</div>
			<div class="form-group row">
				<div class="col-md-1">
					<label for="">Modificar</label>
					<button type="submit" class="btn btn-success">Modificar</button>
				</div>
			</div>
			<h3>PARTES RECIBIDOS</h3>
			<div class="form-group row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>COMPAÑIA</th>
								<th>FECHA ENVIO</th>
								<th>ENVIADO POR</th>
								<th>VER</th>
							</tr>
						</thead>
						<tbody>
							@foreach($parte as $row)
								<tr>
									<td>{{ $row->cia->nombreCompleto() }}</td>
									<td>{{ $row->created_at }}</td>
									<td>{{ $row->responsable->nombreSimple() }}</td>
									<td>
										<a href="{{ route('emergencia.pdf',$row	->getHashId()) }}" 
										class="btn btn-success justify-content-center">
		                    			<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
		                				</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
</form>
@endsection
@section('js')
<script>
	$("#cias").chosen({
		max_selected_options: 9,
		width: "100%"

	}); 
	$("#uni").chosen({
		width: "100%"

	}); 
</script>
@endsection