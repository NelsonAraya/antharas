@extends('layouts.main')

@section('content')

<form method="GET" action="{{ route('conductores.index') }}" class="navbar_form pull-right">
	<div class="col-md-3 pull-right">
		<div class="input-group">
			<input type="text" class="form-control" name="q" placeholder="Buscar usuario por nombre" autocomplete="off">
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit">
			    	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				</button>
			</span>
		</div>
	</div>
</form>
	<table class="table">
		<thead>
			<tr>
				<th>RUN</th>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th>CIA</th>
				<th>MIS UNIDADES</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($usu as $row)
			<tr>
				<td> {{ $row->runCompleto() }} </td>
				<td>{{ $row->nombreSimple() }}  </td>
				<td>{{ $row->cargo->nombre }}  </td>
				<td>{{ $row->cia->nombreCompleto() }}  </td>
				<td>
				<a href="{{ route('conductores.edit',$row->id) }}" class="btn btn-success justify-content-center">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                </a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $usu->render() }}
</div>

@endsection