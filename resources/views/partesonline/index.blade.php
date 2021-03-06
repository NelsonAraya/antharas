@extends('layouts.main')

@section('content')

<div class="form-group row">
	<div class="col-md-12">
		<form method="GET" action="{{ route('partesonline.index') }}" class="navbar_form pull-right">
			<div class="col-md-3 pull-right">
				<div class="input-group">
					<input type="text" class="form-control" name="q" placeholder="Buscar parte por clave" autocomplete="off">
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
						<th>FECHA</th>
						<th>CLAVE</th>
						<th class="hidden-xs">DIRECCION</th>
						<th class="hidden-xs">CIAS</th>
						<th>ESTADO</th>
						<th style="width: 100px;">ACCION</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($eme as $row)

						@php $control=false; @endphp
						@php $control_estado=false; @endphp
						@php $estado="Sin Parte"; @endphp
						@php $cia="" @endphp

						@foreach($row->emergencia->cias as $cias)
						   @php	 $cia=$cia.$cias->cia->numero.'-'; @endphp
						@endforeach

						@php $a=rtrim($cia,'-'); @endphp

						@foreach($row->emergencia->partes as $parte)
								@if($parte->cia_id==Auth::user()->cia_id)
									@if($parte->estado=='T')
										@php $control_estado=true; $estado='Terminado'; @endphp
									@else
										@php $control=true; $estado='Creado'; @endphp	
									@endif

									@php $id_parte=$parte->getHashId(); @endphp
								@endif
						@endforeach

					<tr @if($control_estado) class="success" @elseif($control) class="info"  @endif>
						<td> {{ date('d-m-Y',strtotime($row->emergencia->fecha_emergencia)) }} </td>
						<td>{{ $row->emergencia->clave->clave }} </td>
						<td class="hidden-xs">{{ $row->emergencia->direccion }}  </td>
						<td class="hidden-xs">{{ $a }}</td>
						<td>{{ $estado }}</td>
						<td>
						@if($control==false AND $control_estado==false )	
						<a href="{{ route('partesonline.show',$row->emergencia->getHashId()) }}" 
							class="btn btn-warning justify-content-center">
		                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
		                </a>
		                @endif
		                @if($control)
						<a href="{{ route('partesonline.lista',$id_parte) }}" 
						class="btn btn-success justify-content-center">
		                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
		                </a>
		                @endif
		               	@if($control_estado)
						<a href="{{ route('partesonline.pdf',$id_parte) }}" 
						class="btn btn-success justify-content-center">
		                    <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
		                </a>
		                @endif
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