@extends('layouts.main')

@section('content')
<h3>BITACORA UNIDAD {{ $veh->clave }}</h3>
<div class="panel panel-primary">
	<div class="panel-heading">Bitacora</div>
 	<div class="panel-body">
 		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>F/SALIDA</th>
						<th>F/LLEGADA</th>
						<th class="hidden-xs">H/SALIDA</th>
						<th class="hidden-xs">H/LLEGADA</th>
						<th class="hidden-xs">KM/SALIDA</th>
						<th class="hidden-xs">KM/LLEGADA</th>
						<th class="hidden-xs">CONDUCTOR</th>
						<th class="hidden-xs">OBAC</th>
						<th>DIRECCION</th>
						<th>SERVICIO</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($bitacora as $row)
					<tr>
						<td>
						 {{ date('d-m-Y',strtotime($row->fecha_salida)) }} </td>
						<td> {{ date('d-m-Y',strtotime($row->fecha_llegada)) }}  </td>
						<td class="hidden-xs"> {{ $row->hora_salida }} </td>
						<td class="hidden-xs"> {{ $row->hora_llegada }} </td>
						<td class="hidden-xs"> {{ $row->kmsalida }} </td>
						<td class="hidden-xs"> {{ $row->kmllegada }} </td>
						<td class="hidden-xs"> {{ $row->conductor->nombreSimple() }} </td>
						<td class="hidden-xs"> {{ $row->obac->nombreSimple() }} </td>
						<td> {{ $row->direccion }} </td>
						<td> {{ $row->servicio }} </td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $bitacora->render() }}	
		</div>	
 	</div>
</div>
@endsection