@extends('layouts.main')

@section('content')

<div class="form-group row">
	<div class="col-md-12">
		<form method="GET" action="{{ route('emergencia.index') }}" class="navbar_form pull-right">
			<div class="col-md-1">
				<a href="{{ route('emergencia.create') }}" class="btn btn-info" 
				role="button">Nueva Emergencia</a>
			</div>
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
  		<div class="panel-heading">Listado de Emergencias</div>
  		<div class="panel-body">
	  		<table class="table">
				<thead>
					<tr>
						<th>CLAVE</th>
						<th>FECHA</th>
						<th class="hidden-xs">HORA</th>
						<th class="hidden-xs">DIRECCION</th>
						<th class="hidden-xs">COMPAÑIAS</th>
						<th style="width: 100px;">ACCION</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($eme as $row)
					<tr>
						@php $cia="" @endphp
						@foreach($row->cias as $cias)
						   @php	 $cia=$cia.$cias->cia->numero.'-'; @endphp
						@endforeach
						
						@php $a=rtrim($cia,'-'); @endphp
						
						<td> {{ $row->clave->clave }} </td>
						<td>{{ date('d-m-Y',strtotime($row->fecha_emergencia)) }} </td>
						<td class="hidden-xs">{{ $row->hora_emergencia }}  </td>
						<td class="hidden-xs">{{ $row->direccion }}  </td>
						<td class="hidden-xs">{{ $a }}  </td>
						<td>
						<a href="{{ route('emergencia.edit',$row->getHashId()) }}" 
							class="btn btn-success justify-content-center">
		                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
		                </a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $eme->render() }}		
  		</div>
		</div>
	</div>
</div>

@endsection