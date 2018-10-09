@extends('layouts.main')

@section('content')
<div class="panel panel-primary">
<div class="panel-heading">REPORTE DE ACTIVACION USUARIO : {{ $usu->nombreSimple() }}</div>
	<div class="panel-body">
		<div class="form-group">
			<table class="table">
				<thead>
					<tr>
						<th>ESTADO DE ACTIVIDAD</th>
						<th>FECHA / HORA </th>
					</tr>
				</thead>
				<tbody>
					@foreach($acti as $row)
						<tr>
							<td>@if($row->estado=='S') ACTIVO   @else INACTIVO   @endif</td>
							<td>{{ date('d-m-Y H:i:s',strtotime($row->created_at)) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $acti->render() }}
		</div>
	</div>		
</div>
@endsection