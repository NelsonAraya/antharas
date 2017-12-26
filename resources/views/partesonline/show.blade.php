@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('partesonline.update',$eme->id) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">Crear Parte Online -- {{ $eme->clave->clave }} / 
		{{ date('d-m-Y',strtotime($eme->fecha_emergencia)) }} / {{ $eme->direccion }}</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-4">
					<label for="obac_cia">OBAC CIA</label>
					<select id="obac_cia" data-placeholder="Seleccione OBAC CIA" name="obac_cia" multiple 
					class=" form-control chosen-select">
						@foreach($obac_cia as $row)
								<option  value="{{ $row->id }}"> {{ $row->nombreSimple() }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="obac_cbi">OBAC CBI</label>
					<select id="obac_cbi" data-placeholder="Seleccione OBAC CBI" name="obac_cbi" multiple 
					class=" form-control chosen-select">
						@foreach($obac_cbi as $row)
								<option  value="{{ $row->id }}"> {{ $row->nombreSimple() }}</option>
						@endforeach
					</select>
				</div>				
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label for="dire">ANEXO DIRECCION</label>
					<input type="text" name="anexo_direccion" id="dire" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-2">
					<label for="tipo">LUGAR AMAGADO</label>
					<select id="tipo" name="tipo" class=" form-control">
							<option  value=""> -- Seleccine --</option>
							<option  value="SOLIDO"> Solido</option>
							<option  value="LIGERO"> Ligero</option>
							<option  value="MEJORA"> Mejora</option>
					</select>	
				</div>		
			</div>
			<div class="form-group row">
				<div class="col-md-4">
					<label for="afectado">OCUPADO POR</label>
					<input type="text" name="afectado" id="afectado" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-2">
					<label for="run_afectado">RUN</label>
					<input type="text" name="run_afectado" id="run_afectado" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-2">
					<label for="relacion">RELACION</label>
					<select id="relacion" name="relacion" class=" form-control">
							<option  value=""> -- Seleccine --</option>
							<option  value="PROPIETARIO"> Propietario</option>
							<option  value="ARRENDATARIO"> Arrendatario</option>
							<option  value="OTRO"> Otro</option>
					</select>	
				</div>
				<div class="col-md-4">
					<label for="seguro">SEGURO (Solo Emergencia Estructural)</label>
					<input type="text" name="seguro" id="seguro" class="form-control" autocomplete="off">
				</div>	
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label for="causa">CAUSA</label>
  					<textarea class="form-control" name="causa" rows="3" id="causa" 
  					style="overflow:auto;resize:none"></textarea>
				</div>
				<div class="col-md-6">
					<label for="origen">ORIGEN</label>
  					<textarea class="form-control" name="origen" rows="3" id="origen" 
  					style="overflow:auto;resize:none"></textarea>
				</div>		
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label for="danio">DAÑOS</label>
  					<textarea class="form-control" name="danio" rows="3" id="danio" 
  					style="overflow:auto;resize:none"></textarea>
				</div>
				<div class="col-md-6">
					<label for="info">INFORMACION ADICIONAL</label>
  					<textarea class="form-control" name="info" rows="3" id="info" 
  					style="overflow:auto;resize:none"></textarea>
				</div>		
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label for="trabajo">TRABAJO REALIZADO</label>
  					<textarea class="form-control" name="trabajo" rows="3" id="trabajo" 
  					style="overflow:auto;resize:none"></textarea>
				</div>
				<div class="col-md-6">
					<div class="panel panel-success">
  						<div class="panel-heading">SOLO EMERGENCIAS VEHICULARES</div>
  						<div class="panel-body">
  							<div class="col-md-4">
								<label for="op_rescate">OP. RESCATE</label>
								<input type="number" name="op_rescate" min="0" class="form-control">
							</div>
							<div class="col-md-4">
								<label for="lesionados">LESIONADOS</label>
								<input type="number" name="lesionados" min="0" class="form-control">
							</div>
							<div class="col-md-4">
								<label for="vehiculos">VEHICULOS</label>
								<input type="number" name="vehiculos" min="0" class="form-control">
							</div>	
  						</div>
					</div>
				</div>			
			</div>
			<div class="form-group row">
				<div class="col-md-1">
					<label for="">Registrar</label>
					<button type="submit" class="btn btn-success">Registrar</button>
				</div>
			</div>	
		</div>		
	</div>
</form>
@endsection
@section('js')
<script>
	$("#obac_cia").chosen({
		max_selected_options: 1,
		width: "100%"

	}); 
	$("#obac_cbi").chosen({
		search_contains: true,
		max_selected_options: 1,
		width: "100%"

	}); 
</script>
@endsection