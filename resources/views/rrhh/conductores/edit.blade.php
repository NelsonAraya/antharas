@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('conductores.update',$usu->getHashId()) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">LISTA MATERIAL MAYOR CBI</div>
		<div class="panel-body">
			<div class="form-group row">
				@foreach($mat as $clave => $row)
					@php   $flag=false;  @endphp
                    @foreach($usu->vehiculos as $veh)
                        @if($row->id == $veh->id)
                            @php $flag=true;
                            break;
                            @endphp
                         @else 
                            @php $flag=false;
                            @endphp   
                        @endif
                    @endforeach 
					<div class="col-md-1">
						<label class="checkbox-inline">
						<input type="checkbox" name="vehiculos[]"
						@if($flag) checked="checked" @endif	
						value="{{ $row->id }}">{{ $row->clave }}
						</label>
					</div>
				@endforeach
			</div>
			<div class="form-group row">
				<div class="col-md-1">
					<label for="">Modificar</label>
					<button type="submit" class="btn btn-success">Modificar</button>
				</div>
			</div>
		</div>		
	</div>
</form>
@endsection