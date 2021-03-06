@extends('layouts.main')

@section('content')

<div class="form-group row">
	<div class="col-md-12">
		<form method="GET" action="{{ route('ficha.index') }}" class="navbar_form pull-right">
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
</div>
<div class="form-group row">		
	<div class="col-md-12">
		<div class="panel panel-primary">
  		<div class="panel-heading">Listado de Usuarios</div>
  		<div class="panel-body">
	  		<table class="table">
				<thead>
					<tr>
						<th>RUN</th>
						<th>NOMBRE</th>
						<th class="hidden-xs">CARGO</th>
						<th class="hidden-xs">DOTACION</th>
						<th style="width: 100px;">VER</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($usu as $row)
					<tr>
						<td> {{ $row->runCompleto() }} </td>
						<td>{{ $row->nombreSimple() }} 
							<span class="hidden-lg hidden-md"><br>({{ $row->cargo->nombre }})</span> 
						</td>
						<td class="hidden-xs">{{ $row->cargo->nombre }}  </td>
						<td class="hidden-xs">{{ $row->cia->nombreCompleto() }}  </td>
						<td>
		                 <a href="{{ route('ficha.edit',$row->getHashId()) }}" class="btn btn-success justify-content-center">
		                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
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
</div>

@endsection