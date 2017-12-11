@extends('layouts.main')

@section('content')

<div class="form-group row">
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
</div>

@endsection