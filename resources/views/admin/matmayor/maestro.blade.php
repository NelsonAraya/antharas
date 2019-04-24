@extends('layouts.main')
@section('content')
<form method="POST" action="#">
	{{ csrf_field() }}
	<div class="panel panel-primary">
	<div class="panel-heading">MAESTRO MATERIAL MAYOR</div>
		<div class="panel-body">
			<div class="form-group row">	
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">NEUMATICO IZQUIERDO DELANTERO</div>
						  <div class="panel-body">
            					<div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MARCA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">TIPO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>
            					<div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MEDIDA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">PRESION</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>		
						  </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">NEUMATICO DERECHO DELANTERO</div>
						  <div class="panel-body">
						        <div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MARCA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">TIPO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>
            					<div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MEDIDA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">PRESION</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>	
						  </div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">NEUMATICO IZQUIERDO EXTERIOR</div>
						  <div class="panel-body">
						        <div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MARCA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">TIPO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>
            					<div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MEDIDA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">PRESION</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>	
						  </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">NEUMATICO DERECHO EXTERIOR</div>
						  <div class="panel-body">
						        <div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MARCA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">TIPO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>
            					<div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MEDIDA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">PRESION</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>	
						  </div>
					</div>
				</div>				
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading">NEUMATICO IZQUIERDO INTERIOR (SOLO SI CORRESPONDE)</div>
						  <div class="panel-body">
						        <div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MARCA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">TIPO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>
            					<div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MEDIDA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">PRESION</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>	
						  </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-danger">
						<div class="panel-heading">NEUMATICO DERECHO INTERIOR (SOLO SI CORRESPONDE)</div>
						  <div class="panel-body">
						        <div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MARCA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">TIPO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>
            					<div class="form-group row">
            						<div class="col-md-6">
										<label for="nidelantero">MEDIDA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-6">
										<label for="nidelantero">PRESION</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>	
						  </div>
					</div>
				</div>				
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">CUERPO BOMBA Y ESTANQUE</div>
						  <div class="panel-body">
						        <div class="form-group row">
            						<div class="col-md-3">
										<label for="nidelantero">MODELO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-3">
										<label for="nidelantero">CANT. ESTANQUE AGUA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-3">
										<label for="nidelantero">CANT. ESTANQUE ESPUMA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>
						  </div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">COMBUSTIBLE Y CAJA DE CAMBIOS</div>
						  <div class="panel-body">
						        <div class="form-group row">
						        	<div class="col-md-3">
										<label for="nidelantero">TIPO. COMBUSTIBLE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            						<div class="col-md-3">
										<label for="nidelantero">CAP. COMBUSTIBLE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-3">
										<label for="nidelantero">TRACCION</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-3">
										<label for="nidelantero">TIPO CAJA CAMBIO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>
						  </div>
					</div>
				</div>
			</div>
			<div class="form-group row">	
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">ACEITE DE CAJA</div>
						  <div class="panel-body">
            					<div class="form-group row">
            						<div class="col-md-4">
										<label for="nidelantero">TIPO ACEITE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-4">
										<label for="nidelantero">MARCA</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-4">
										<label for="nidelantero">CANTIDAD</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>		
						  </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">ACEITE DE MOTOR</div>
						  <div class="panel-body">
						        <div class="form-group row">
            						<div class="col-md-4">
										<label for="nidelantero">TIPO ACEITE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-4">
										<label for="nidelantero">MARCA ACEITE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-4">
										<label for="nidelantero">CANTIDAD</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>	
						  </div>
					</div>
				</div>
			</div>			
			<div class="form-group row">	
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">FILTROS</div>
						  <div class="panel-body">
            					<div class="form-group row">
            						<div class="col-md-4">
										<label for="nidelantero">ACEITE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-4">
										<label for="nidelantero">AIRE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-4">
										<label for="nidelantero">PETROLEO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>		
						  </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">HIDRAULICOS</div>
						  <div class="panel-body">
						        <div class="form-group row">
            						<div class="col-md-4">
										<label for="nidelantero">TIPO ACEITE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-4">
										<label for="nidelantero">MARCA ACEITE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-4">
										<label for="nidelantero">CANTIDAD</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>	
						  </div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">REFRIGERANTES Y FRENOS</div>
						  <div class="panel-body">
            					<div class="form-group row">
            						<div class="col-md-3">
										<label for="nidelantero">TIPO REFRIGERANTE</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-2">
										<label for="nidelantero">CANTIDAD</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-2">
										<label for="nidelantero">TIPO LIQUIDO FRENO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-3">
										<label for="nidelantero">MARCA LIQUIDO FRENO</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
									<div class="col-md-2">
										<label for="nidelantero">CANTIDAD</label>
										<input id="nidelantero" name="nidelantero" class="form-control" autocomplete="off" autofocus>
									</div>
            					</div>		
						  </div>
					</div>
				</div>
			</div>												
		</div>		
	</div>
@endsection