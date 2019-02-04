@extends('layouts.main')
@section('css')
<style type="text/css">
	/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection
@section('content')
<form method="POST" action="{{ route('ficha.update',$usu->getHashId()) }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="panel panel-primary">
	<div class="panel-heading">FICHA CLINICA </div>
		<div class="panel-body">
			<div class="form-group row">
				<div class="col-md-2">
					<label>RUN</label>
					<br>
					<span>{{ $usu->runCompleto() }}</span>
				</div>
				<div class="col-md-1">
					<label for="rol">ROL</label>
					<br>
					<span>{{ $usu->rol }}</span>
				</div>
				<div class="col-md-3">
					<label for="nombres">NOMBRE</label>
					<br>
					<span>{{ $usu->nombreSimple() }}</span>
				</div>
				<div class="col-md-2">
					<label for="nacimiento">NACIMIENTO</label>
					<br>
					<span>{{ date("d-m-Y", strtotime($usu->fecha_nacimiento)) }}</span>
				</div>
				<div class="col-md-2">
					<label for="cia">DOTACION</label>
					<br>
					<span> {{ $usu->cia->nombre.' N°'.$usu->cia->numero }} </span>
				</div>
				<div class="col-md-2">
					<label for="cargo">CARGO</label>
					<br>
					<span>{{ $usu->cargo->nombre }}</span>
				</div>
			</div>
			<div class="form-group row">				
				<div class="col-md-1">
					<label for="fono">EDAD</label>
					<br>
					<span>{{ $edad }}</span>
				</div>
				<div class="col-md-3">
					<label for="dire">DIRECCION</label>
					<br>
					<span>{{ $usu->direccion }}</span>
				</div>
				<div class="col-md-2">
					<label for="fono">TELEFONO</label>
					<br>
					<span>{{ $usu->telefono }}</span>
				</div>
				<div class="col-md-2">
					<label for="sanguineo">GRUPO SANGUINEO</label>
					<br>
					<span>{{ $usu->grupoSanguineo->nombre }}</span>
				</div>
				<div class="col-md-1">
					<label>CRONICO</label>
	  				<label class="switch checkbox-inline"><input type="checkbox" 
	  				@if($usu->cronico=='S') checked="checked" @endif name="cronico" value="S">
	  					<span class="slider round"></span>
	  				</label>
	  			</div>				
			</div>
			<div class="form-group row">
				<div class="col-md-1">
					<label for="peso">PESO</label>
					<input id="peso" name="peso" class="form-control" autocomplete="off"
					 value="@if($usu->ficha != null ) {{ $usu->ficha->peso }}  @endif">
				</div>
				<div class="col-md-1">
					<label for="talla">TALLA</label>
					<input id="talla" name="talla" class="form-control" autocomplete="off"
					value="@if($usu->ficha != null ) {{ $usu->ficha->talla }}  @endif">
				</div>
				<div class="col-md-1">
					<label for="imc">IMC</label>
					<input id="imc" name="imc" class="form-control" autocomplete="off"
					value="@if($usu->ficha != null ) {{ $usu->ficha->imc }}  @endif">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-4">
					<label for="ct1">NOMBRE CONTACTO</label>
					<input id="ct1" name="contacto1" class="form-control" autocomplete="off"
					value="{{ $usu->ficha->contacto1 }}">
				</div>
				<div class="col-md-2">
					<label for="fono1">TELEFONO CONTACTO</label>
					<input id="fono1" name="fono1" class="form-control" autocomplete="off"
					value="{{ $usu->ficha->fono1 }}">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-4">
					<label for="ct2">NOMBRE CONTACTO</label>
					<input id="ct2" name="contacto2" class="form-control" autocomplete="off"
					value="{{ $usu->ficha->contacto2 }}">
				</div>
				<div class="col-md-2">
					<label for="fono2">TELEFONO CONTACTO</label>
					<input id="fono2" name="fono2" class="form-control" autocomplete="off"
					value="{{ $usu->ficha->fono2 }}">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label for="quiru">ANTECEDENTES QUIRURGICO</label>
  					<textarea class="form-control" name="quiru" rows="3" id="quiru" 
  					style="overflow:auto;resize:none">@if($usu->ficha != null ) {{ $usu->ficha->quirurgicos }}  @endif</textarea>
				</div>
				<div class="col-md-6">
					<label for="alergia">ALERGIAS</label>
  					<textarea class="form-control" name="alergia" rows="3" id="alergia" 
  					style="overflow:auto;resize:none">@if($usu->ficha != null ){{ $usu->ficha->alergias }}  @endif</textarea>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="trata">TRATAMIENTO FARMACOLOGICO</label>
  					<textarea class="form-control" name="trata" rows="3" id="trata" 
  					style="overflow:auto;resize:none">@if($usu->ficha != null ) {{ $usu->ficha->tratamientos }}  @endif</textarea>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="enfermedad">ENFERMEDADES</label>
					<select id="enfermedad" data-placeholder="Seleccione Enfermedades" 
					name="enfermedad[]" multiple 
					class=" form-control chosen-select">
						@foreach($enf as $key => $value)
							@php $control=false;  @endphp
							@foreach($usu->enfermedades as $row)
									 @if($row->id==$key)
									 	@php $control=true;  @endphp
									 @endif
								@endforeach
							<option @if($control) selected @endif value="{{ $key }}"> {{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label for="otras">OTRAS ENFERMEDADES</label>
  					<textarea class="form-control" name="otras" rows="3" id="otras" 
  					style="overflow:auto;resize:none">@if($usu->ficha != null ) {{ $usu->ficha->otras }}  @endif</textarea>
				</div>
			</div>
			<div class="form-group row">
		
				<div class="col-md-1">
					<label for="">Guardar</label>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</div>		
	</div>
</form>
@endsection
@section('js')
<script>
	$("#enfermedad").chosen({
		width: "100%"

	}); 
</script>
@endsection