@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('material_mayor.update',$veh->id) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">EDITAR INFORMACION MATERIAL MAYOR</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="patente">PATENTE</label>
					<input id="patente" name="patente" class="form-control" autocomplete="off" autofocus value="{{ $veh->patente }}">
				</div>
				<div class="col-md-1">
					<label for="clave">CLAVE</label>
					<input id="clave" name="clave" class="form-control" autocomplete="off" 
					value="{{ $veh->clave }}">
				</div>
				<div class="col-md-2">
					<label for="modelo">MODELO</label>
					<input id="modelo" name="modelo" class="form-control" autocomplete="off"
					value="{{ $veh->modelo }}">
				</div>
				<div class="col-md-2">
					<label for="marca">MARCA</label>
					<input id="marca" name="marca" class="form-control" autocomplete="off"
					value="{{ $veh->marca }}">
				</div>
				<div class="col-md-1">
					<label for="anio">AÑO</label>
					<input id="anio" name="anio" class="form-control" autocomplete="off"
					value="{{ $veh->anio }}">
				</div>
				<div class="col-md-3">
					<label for="cia">DOTACION</label>
					<select id="cia" name="cia_id" class="form-control">
						<option value="">--Seleccione--</option>
						@foreach($cia as $key => $value)
							@if($veh->cia_id==$key)
								<option value="{{ $key }}" selected> {{ $value }}</option>
							@else
								<option value="{{ $key }}"> {{ $value }}</option>
							@endif
						@endforeach
					</select>
				</div>		
			</div>
			<div class="form-group row">
				<div class="col-md-2">
					<label for="orden">ORDEN</label>
					<select id="orden" name="orden" class="form-control">
						<option value="">--Seleccione--</option>
						<option value="1" @if($veh->orden=='1') selected  @endif >PRIMERO</option>
						<option value="2" @if($veh->orden=='2') selected  @endif >SEGUNDO</option>
						<option value="3" @if($veh->orden=='3') selected  @endif >TERCERO</option>
					</select>
				</div>
				<div class="col-md-2">
					<label for="estado">ESTADO</label>
					<select id="estado" name="estado" class="form-control">
						<option value="">--Seleccione--</option>
						<option value="A" @if($veh->estado=='A') selected  @endif> Activo</option>
						<option value="I" @if($veh->estado=='I') selected  @endif> Inactivo</option>
					</select>
				</div>	
				<div class="col-md-1">
					<label for="">Modificar</label>
					<button type="submit" class="btn btn-success">Modificar</button>
				</div>	
			</div>
</form>
			<div class="form-group row">
				<div class="col-md-4">
					<form method="POST" action="{{ route('material_mayor.revision',$veh->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
					<label>Agregar Revision Tecnica</label>
				    <div class="input-group col-md-6">
					    <input type="date" name="fecha_vencimiento" class="form-control">
					    <span class="input-group-btn">
					    	<button class="btn btn-primary" type="submit">Agregar</button>
					    </span>
					</div>
					</form>
					<table class="table">
						<thead>
							<tr>
								<th>Fecha Vencimiento Revision</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($rev as $row)
							<tr>
								<td> {{ $row->fecha_vencimiento }} </td>
								<td>
								<a href="#" class="btn btn-danger justify-content-center">
					                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					            </a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $rev->render() }}
				</div>
				<div class="col-md-4">
				<form method="POST" action="{{ route('material_mayor.permiso',$veh->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
					<label>Agregar Permiso Circulacion</label>
				    <div class="input-group col-md-6">
					    <input type="date" name="fecha_vencimiento" class="form-control">
					    <span class="input-group-btn">
					    	<button class="btn btn-primary" type="submit">Agregar</button>
					    </span>
					</div>
					</form>								
					<table class="table">
						<thead>
							<tr>
								<th>Fecha Vencimiento Permiso</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($per as $row)
							<tr>
								<td> {{ $row->fecha_vencimiento }} </td>
								<td>
								<a href="#" class="btn btn-danger justify-content-center">
					                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					            </a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $per->render() }}
				</div>
				<div class="col-md-4">
			<form method="POST" action="{{ route('material_mayor.seguro',$veh->id) }}">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
					<label>Agregar Seguro</label>
				    <div class="input-group col-md-6">
					    <input type="date" name="fecha_vencimiento" class="form-control">
					    <span class="input-group-btn">
					    	<button class="btn btn-primary" type="submit">Agregar</button>
					    </span>
					</div>
					</form>					
					<table class="table">
						<thead>
							<tr>
								<th>Fecha Vencimiento Seguro</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($seg as $row)
							<tr>
								<td> {{ $row->fecha_vencimiento }} </td>
								<td>
								<a href="#" class="btn btn-danger justify-content-center">
					                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					            </a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $seg->render() }}
				</div>
			</div>
		</div>		
	</div>
@endsection