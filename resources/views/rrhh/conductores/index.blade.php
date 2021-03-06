@extends('layouts.main')

@section('content')
<div class="form-group row">
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
</div>
<div class="form-group row">
	<div class="panel panel-primary">
  		<div class="panel-heading">Lista de Conductores</div>
  		<div class="panel-body">
  			<table class="table">
				<thead>
					<tr>
						<th>RUN</th>
						<th>NOMBRE</th>
						<th class="hidden-xs">CARGO</th>
						<th class="hidden-xs">CIA</th>
						<th style="width: 100px;">UNIDADES</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($usu as $row)
					<tr>
						<td> {{ $row->runCompleto() }} </td>
						<td>{{ $row->nombreSimple() }}  </td>
						<td class="hidden-xs">{{ $row->cargo->nombre }}  </td>
						<td class="hidden-xs">{{ $row->cia->nombreCompleto() }}  </td>
						<td>
						<a href="{{ route('conductores.edit',$row->getHashId()) }}" class="btn btn-success justify-content-center">
		                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
		                </a>
		                <a href="{{ route('conductores.reporte',$row->getHashId()) }}" class="btn btn-info justify-content-center">
		                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
		                </a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $usu->render() }}	
  		</div>
	</div>
</div>
@endsection