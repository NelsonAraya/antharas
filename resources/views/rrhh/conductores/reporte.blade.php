@extends('layouts.main')

@section('content')
<div class="panel panel-primary">
<div class="panel-heading">REPORTE DE ACTIVACION USUARIO : {{ $usu->nombreSimple() }}</div>
	<div class="panel-body">
		<div class="form-group">
			<table class="table">
				<thead>
					<tr>
						<th>VEHICULO</th>
						<th>ESTADO</th>
						<th>FECHA</th>
					</tr>
				</thead>
				<tbody>
					@foreach($acti as $row)
						<tr>
							<td>{{ $row->vehiculo->clave}}</td>
							<td>
								@if($row->estado=='S') 
								ACTIVADO   
								@else 
									@if($row->operador_id==null)
									DESACTIVADO 
									@else
									DESACTIVADO POR OPERADOR
									@endif  
								@endif
							</td>
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