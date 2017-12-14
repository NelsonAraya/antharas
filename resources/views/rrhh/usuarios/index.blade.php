@extends('layouts.main')

@section('content')

<div class="form-group row">
	
<form method="GET" action="{{ route('usuarios.index') }}" class="navbar_form pull-right">
	<a href="{{ route('usuarios.create') }}" class="btn btn-info" role="button">Nuevo Usuario</a>
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
				<th>DOTACION</th>
				<th>ACCION</th>
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
				<a href="{{ route('usuarios.roles',$row->id) }}" 
					class="btn btn-warning justify-content-center">
                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                </a>
				<a href="{{ route('usuarios.edit',$row->id) }}" class="btn btn-success justify-content-center">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                </a>
                <a href="" class="btn btn-danger justify-content-center">
   		           <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $usu->render() }}
</div>

@endsection