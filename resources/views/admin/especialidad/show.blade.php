@extends('layouts.main')

@section('content')
<div class="panel panel-primary">
<div class="panel-heading">LISTADO DE USUARIOS CON ESPECIALIDAD <b>{{ strtoupper($esp) }} TOTAL : {{ $total }} USUARIOS </b> </div>
	<div class="panel-body">
		<div class="form-group">
			<table class="table">
				<thead>
					<tr>
						<th>USUARIO</th>
						<th>CARGO</th>
						<th>COMPAÑIA</th>
					</tr>
				</thead>
				<tbody>
					@foreach($usu as $row)
						<tr>
							<td>{{ $row->nombreSimple() }}</td>
							<td>{{ $row->cargo->nombre }}</td>
							<td>{{ $row->cia->nombreCompleto() }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>		
</div>
@endsection