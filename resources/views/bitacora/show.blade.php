@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('bitacora.update',$veh) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">Nueva Bitacora</div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label for="fsalida">F/SALIDA</label>
					<input type="date" id="fsalida" name="fecha_salida" class="form-control">
				</div>
				<div class="col-md-2">
					<label for="hsalida">H/SALIDA</label>
					<input type="time" id="hsalida" name="hora_salida" class="form-control">
				</div>
				<div class="col-md-2">
					<label for="kmsalida">KM/SALIDA</label>
					<input type="text" id="kmsalida" name="kmsalida" class="form-control"
					@if($bi==null) value="0" @else value="{{ $bi->kmllegada }}" @endif readonly >
				</div>
				<div class="col-md-2">
					<label for="fllegada">F/LLEGADA</label>
					<input type="date" id="fllegada" name="fecha_llegada" class="form-control">
				</div>
				<div class="col-md-2">
					<label for="hllegada">H/LLEGADA</label>
					<input type="time" id="hllegada" name="hora_llegada" class="form-control">
				</div>
				<div class="col-md-2">
					<label for="kmllegada">KM/LLEGADA</label>
					<input type="text" id="kmllegada" name="kmllegada" class="form-control" autocomplete="off">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label for="dire">DIRECCION</label>
					<input type="text" id="dire" name="direccion" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-3">
					<label for="conductor">CONDUCTOR</label>
					<input type="text" id="conductor" name="conductor_id" class="form-control" autocomplete="off">
				</div>
				<div class="col-md-3">
					<label for="obac">OBAC</label>
					<input type="text" id="obac" name="obac_id" class="form-control" autocomplete="off">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2">
					<label for="servicio">SERVICIO</label>
					<input type="text" id="servicio" name="servicio" class="form-control" autocomplete="off">
				</div>
			</div>
			<div class="form-group row">		
				<div class="col-md-1">
					<label for="">Agregar</label>
					<button type="submit" id="btn_guardar" class="btn btn-success">Agregar</button>
				</div>
			</div>
		</div>		
	</div>
</form>
@endsection
@section('js')
<script>
$(function() {

	$("#conductor").autocomplete({
	    source: "{{ URL('bitacora/search') }}",
	    minLength: 3,
	    select: function(event, ui) {
	      $('#conductor').val(ui.item.value);
	      $("#conductor").attr("data-id", ui.item.id);
	    }
  	});

  	$("#obac").autocomplete({
	    source: "{{ URL('bitacora/searchVol') }}",
	    minLength: 3,
	    select: function(event, ui) {
	      $('#obac').val(ui.item.value);
	      $("#obac").attr("data-id", ui.item.id);
	    }
  	});

  	$("#btn_guardar").click(function() {
  
      $("#obac").val($("#obac").data("id"));
      $("#conductor").val($("#conductor").data("id"));
    });

});
</script>
@endsection