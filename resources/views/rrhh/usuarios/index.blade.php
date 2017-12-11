@extends('layouts.main')

@section('content')

<div class="form-group row">
	<a href="{{ route('usuarios.create') }}" class="btn btn-info" role="button">Nuevo Usuario</a>
	<div class="col-md-3 pull-right">
	    <div class="input-group">
	      <input type="text" class="form-control" placeholder="Busqueda por...">
	      <span class="input-group-btn">
	        <button class="btn btn-primary" type="button">Go!</button>
	      </span>
	    </div><!-- /input-group -->
  	</div><!-- /.col-lg-6 -->
	<table class="table">
		<thead>
			<tr>
				<th>RUN</th>
				<th>NOMBRE</th>
				<th>CARGO</th>
				<th>CIA</th>
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
				<a href="" class="btn btn-warning justify-content-center">
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
</div>

@endsection