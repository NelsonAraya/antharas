@extends('layouts.main')
@section('css')
<style type="text/css">
	
.parpadea {
  
  animation-name: parpadeo;
  animation-duration: 1s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 1s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {  
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

.teniente {
    border: 3px solid #dddddd;
    border-radius: 5px;
    border-color: red;
}
.capitan {
    border: 3px solid #dddddd;
    border-radius: 5px;
    border-color: #FFFF00;
}
.comandante {
    border: 3px solid #dddddd;
    border-radius: 5px;
    border-color: #2853FF;
}
.voluntario {
    border: 3px solid #dddddd;
    border-radius: 5px;
    border-color: #2DF002;
}
.inspectores {
    border: 3px solid #dddddd;
    border-radius: 5px;
    border-color: #FF8A29;
}

.conductor{
    
    /*border-right: 3px white solid;*/
	border-left: 3px black solid;
	border-top: 3px black solid;
	/*border-bottom: 3px white solid;*/
}
.linea{

    display: inline-block;
}
.material{
	width: 100%;
	height: 50px;
	position: relative;
	cursor: pointer;
}
.material p{
	margin: 0;
	padding: 0;
	text-align: center;
	position: relative;
	top: 50%;
	transform: translateY(-50%);
	font-size: 20px;
}
.tocar-centro {
  width: 100%;
  height: 100px;
  margin: 0 auto;
  text-align: center;
}
</style>
@endsection
@section('content')
<div class="form-group row">
	<div class="col-md-2">
		<a id="btn" href="#" class="btn btn-info btn-lg linea" role="button">Ver Unidades</a>
	</div>	
	<div class="col-md-3">
		<select id="select_tono" class="form-control col-md-2">
		  <option value="all">TODOS LOS TONO</option>
		  <option value="cuartel_1x">TONO 1 CIA</option>
		  <option value="cuartel_2x">TONO 2 CIA</option>
		  <option value="cuartel_4x">TONO 3 CIA</option>
		</select>
	</div>
	<div class="col-md-3">
		<select id="tono_activacion" class="form-control col-md-2">
		  <option value="si">ESCUCHAR ACTIVACION</option>
		  <option value="no">SILENCIAR ACTIVACION</option>
		</select>
	</div>
</div>
<div class="form-group row">		
<div id="tabla_vol" class="table-responsive col-md-12">
	<table class="table">
		<thead>
			<tr>
				@foreach($cia as $row)
					@if ($row->numero != 100)
					<th style="width: 10%; text-align: center; border: 1px solid green; background-color: white;">
						<div id="xcia_{{ $row->id }}" class="xcia" style="cursor: pointer;">
							Cia N°{{ $row->numero }}<br>
							En Cuartel : <span id="cia_{{ $row->id }}"></span>
						</div>	
					</th>
					@endif
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($cia as $row)
					@if($row->id!=11)
					<td >
						<table>
						@foreach($row->usuariosCargoVisor as $usu)
							@if($usu->estado=='A' && $usu->cia_id!=11)
							@php
								$foto = URL::asset('/usuarios/') ;
								$foto = $foto."/".$usu->rol.".jpg"; 
								$sinfoto = URL::asset('/usuarios/') ;
								$sinfoto = $sinfoto."/avatar.jpg";
								$control= public_path("usuarios/".$usu->rol.'.jpg');
								/*background-image: url('{{$foto}}')*/
							 @endphp
							<tr>
								<td id="{{ $usu->id }}" style=" width: 10%; display: none;">
									<div id="_{{ $usu->id }}" class="panel panel-default op"
										@if (file_exists($control))
										style="background-image: url('{{$foto}}'); width: 100px; height: 70px;
										background-repeat: no-repeat; background-position: center;
										background-size:100% 100%; cursor: pointer"
										@else
										style="background-image: url('{{$sinfoto}}'); width: 100px; height: 70px; 
										background-repeat: no-repeat; background-position: center;
										background-size:100% 100%; cursor: pointer"
										@endif
										>							 
									</div>
		  						</td>
							</tr>
							@endif
						@endforeach
						</table>		
					</td>
					@else

					@endif
				@endforeach
			</tr>	
		</tbody>
	</table>   	
</div>
<audio id="tono" src="{{ asset('sonidos/evento.ton') }}" preload="auto"></audio>
<audio id="cuartel_1x" src="{{ asset('sonidos/1.wav') }}" preload="auto"></audio>
<audio id="cuartel_2x" src="{{ asset('sonidos/2.wav') }}" preload="auto"></audio>
<audio id="cuartel_2Rx" src="{{ asset('sonidos/2R.wav') }}" preload="auto"></audio>
<audio id="cuartel_4x" src="{{ asset('sonidos/4.wav') }}" preload="auto"></audio>
<audio id="cuartel_5x" src="{{ asset('sonidos/5.wav') }}" preload="auto"></audio>
<audio id="cuartel_6x" src="{{ asset('sonidos/6.wav') }}" preload="auto"></audio>
<audio id="cuartel_6Rx" src="{{ asset('sonidos/6R.wav') }}" preload="auto"></audio>
<audio id="cuartel_7x" src="{{ asset('sonidos/7.wav') }}" preload="auto"></audio>
<audio id="cuartel_11x" src="{{ asset('sonidos/11.wav') }}" preload="auto"></audio>
<audio id="cuartel_11Rx" src="{{ asset('sonidos/11R.wav') }}" preload="auto"></audio>
<audio id="cuartel_12x" src="{{ asset('sonidos/12.wav') }}" preload="auto"></audio>
<audio id="cuartel_14x" src="{{ asset('sonidos/14.wav') }}" preload="auto"></audio>
<audio id="cuartel_14Rx" src="{{ asset('sonidos/14R.wav') }}" preload="auto"></audio>
<audio id="cuartel_16x" src="{{ asset('sonidos/16.wav') }}" preload="auto"></audio>
<audio id="tono_estructural" src="{{ asset('sonidos/estructural.wav') }}" preload="auto"></audio>
<audio id="tono_incendio" src="{{ asset('sonidos/incendio.wav') }}" preload="auto"></audio>
<audio id="tono_rescate" src="{{ asset('sonidos/rescate.wav') }}" preload="auto"></audio>
<audio id="tono_hazmat" src="{{ asset('sonidos/hazmat.wav') }}" preload="auto"></audio>	
<audio id="tono_otros" src="{{ asset('sonidos/otros.wav') }}" preload="auto"></audio>	
<div id="tabla_uni" class="table-responsive col-md-12" style="display: none">
	<table class="table">
		<thead>
			<tr>
				@foreach($cia as $row)
					@if ($row->numero != 100)
					<th  style="width: 10%; text-align: center; border: 1px solid green; background-color: white;">Cia N°{{ $row->numero }}</th>
					@endif
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($cia as $row)
					<td >
						<table>
						@foreach($row->vehiculos as $mat)
							@if($mat->estado=='A')
							<tr style="width: 10px;">
							<!--	<td> -->
									<div id="{{ $mat->getHashId() }}" class="panel panel-default un material">
									   <p><b>{{ $mat->clave }}</b></p>  
									</div>
		  					<!--	</td> -->
							</tr>
							@endif
						@endforeach
						</table>		
					</td>
				@endforeach
			</tr>	
		</tbody>
	</table>   	
</div>
</div>

<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Mnombre">DATOS DE USUARIO</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Mnombre">DATOS DE MATERIAL MAYOR</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="modal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Mnombre">DATOS GENERAL CIA</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('js')
<script src="{{ asset('js/timer.jquery.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var tono_select= $( "#select_tono option:selected" ).val();
		
		$("#select_tono").change(function() {
 			tono_select=$( "#select_tono option:selected" ).val();
		});
		
		var t_activacion= $( "#tono_activacion option:selected" ).val();
		$("#tono_activacion").change(function() {
 			t_activacion=$( "#tono_activacion option:selected" ).val();
		});
		@auth
	    	@if(Auth::user()->cargo_id == 24 || Auth::user()->cargo_id == 9 )

				$(document).on('click','.op',function(e){
					
					var flag = false;
					if(e.target.id.indexOf('_')){
						flag=true;
					}else{
						flag=false;
					}
					if(flag){	
					var str = this.id;
				    var url = "{{ URL::route('visor.activacion',['vol','N']) }}";
				    var url2 = url.replace('vol',str);
	 				$.ajaxSetup({
	        			headers: {
	            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        			}
	    			});
	    		
				    $.ajax({
				        url : url2,
				        success : function(data){
				        		
				        		$('#modal').modal('hide');
				        		alert("Usuario Desactivado");
				        		
				            }
				        });
					
					}
				})

				$(document).on('click','.un',function(e){
					var flag = false;
					if(e.target.id.indexOf('__')==0){
						flag=true;
					}else{
						flag=false;
					}

					if(flag){	
					var uni = this.id;
					var usu = $(this).data('conductor');
				    var url = "{{ URL::route('visor.unidad',['usu','uni','N']) }}"
				    var url3 = url.replace('uni',uni.substr(2,2)).replace('usu',usu);
	 				$.ajaxSetup({
	        			headers: {
	            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        			}
	    			});
	    			
				    $.ajax({
				        url : url3,
				        success : function(data){
				        		
				        		$('#modal2').modal('hide');
				        		alert("Unidad Desactivada");
				        		
				            }
				        });
										
					}
				})
			@endif
    	@endauth
    	$(".op").on('click', function(event){
    		var id = $(this).attr("id");
    		id = id.substring(1);
    		 $('#modal').modal('show');
    		 var x = "{{ URL::route('visor.usuario','id') }}";
			 var x2 = x.replace('id',id);
    		 $('.modal-body').load(x2,function(){});
		});

    	$(".un").on('click', function(event){
    		var id = $(this).attr("id");
    		$('#modal2').modal('show');
    		 var x = "{{ URL::route('visor.info','id') }}";
			 var x2 = x.replace('id',id);
    		 $('.modal-body').load(x2,function(){});
		});

		$(".xcia").on('click', function(event){
    		var id = $(this).attr("id");
    		id = id.substring(5);
    		 $('#modal3').modal('show');
			 var x = "{{ URL::route('visor.xcia','id') }}";
			 var x2 = x.replace('id',id);
    	   $('.modal-body').load(x2,function(){});
		});


    	$('.modal').on('hidden.bs.modal', function(){
    		 $("#modal .modal-body").html('');
		});

 		$( "#btn" ).click(function() {
 			if(document.getElementById('tabla_uni').style.display=="none"){
 				$("#tabla_vol").hide("slow");
 				$("#tabla_uni").show("slow");
 				$(this).html("Ver Voluntarios");
 				$(this).removeClass( "btn-info" ).addClass( "btn-primary" );
 			}else{
 				$("#tabla_uni").hide("slow");
 				$("#tabla_vol").show("slow");
 				$(this).html("Ver Unidades");
 				$(this).removeClass( "btn-primary" ).addClass( "btn-info" );
 			}
		});

		var getUrlParameter = function getUrlParameter(sParam) {
			    var sPageURL = window.location.search.substring(1),
			        sURLVariables = sPageURL.split('&'),
			        sParameterName,
			        i;

			    for (i = 0; i < sURLVariables.length; i++) {
			        sParameterName = sURLVariables[i].split('=');

			        if (sParameterName[0] === sParam) {
			            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			        }
			    }
		};
		var tech = getUrlParameter('x');
		var tech1 = getUrlParameter('c');
		var tech2 = getUrlParameter('tono');
		if(tech==1){
				if(tech1=='all'){
					$("#select_tono").val('all').change();
				}else if(tech1=='1x'){
					$("#select_tono").val('cuartel_1x').change();
				}else if(tech1=='2x'){
					$("#select_tono").val('cuartel_2x').change();
				}else if(tech1=='4x'){
					$("#select_tono").val('cuartel_4x').change();
				}else if(tech1=='5x'){
					$("#select_tono").val('cuartel_5x').change();
				}else if(tech1=='6x'){
					$("#select_tono").val('cuartel_6x').change();
				}else if(tech1=='7x'){
					$("#select_tono").val('cuartel_7x').change();
				}else if(tech1=='11x'){
					$("#select_tono").val('cuartel_11x').change();
				}else if(tech1=='12x'){
					$("#select_tono").val('cuartel_12x').change();
				}else if(tech1=='14x'){
					$("#select_tono").val('cuartel_14x').change();
				}else if(tech1=='16x'){
					$("#select_tono").val('cuartel_16x').change();
				}
				var flag_refresh=false;
				@auth
					@if(Auth::user()->hasRole('tono'))
			 			$("#tabla_vol").hide();
		 				$("#tabla_uni").show("slow");
		 				flag_refresh=true;
			 		@else
		 				$("#tabla_uni").hide();
		 				$("#tabla_vol").show("slow");
		 				flag_refresh=true;
		 			@endif	
				@endauth
				if(flag_refresh==false){
 					$("#tabla_uni").hide();
 					$("#tabla_vol").show("slow");
 				}
		}

		if(tech2 != undefined){
			if(tech2=='si'){
				$("#tono_activacion").val('si').change();			
			}else{
				$("#tono_activacion").val('no').change();
			}
		}

    	$('[data-toggle="popover"]').popover();  

    	var cia_x1=0;
		var cia_x2=0;
		var cia_x4=0;
		var cia_x5=0;
		var cia_x6=0;
		var cia_x7=0;
		var cia_x11=0;
		var cia_x12=0;
		var cia_x14=0;
		var cia_x16=0;
		var cia_xx=0;
       $('#cia_1').text(cia_x1);
       $('#cia_2').text(cia_x2);
       $('#cia_3').text(cia_x4);
       $('#cia_4').text(cia_x5);
       $('#cia_5').text(cia_x6);
       $('#cia_6').text(cia_x7);
       $('#cia_7').text(cia_x11);
       $('#cia_8').text(cia_x12);
       $('#cia_9').text(cia_x14);
       $('#cia_10').text(cia_x16);
       $('#cia_11').text(cia_xx);

    function getActivados(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});	
    $.ajax({
    	contentType: "application/json; charset=utf-8",
        url : "{{ URL::route('visor.vol') }}",
        success : function(data){

        			var cia_x1=0;
					var cia_x2=0;
					var cia_x4=0;
					var cia_x5=0;
					var cia_x6=0;
					var cia_x7=0;
					var cia_x11=0;
					var cia_x12=0;
					var cia_x14=0;
					var cia_x16=0;
					var cia_xx=0;
        		
        		$.each( data, function( key, value ) {

        			var control_conductor=false;
			       $('#cia_1').text(cia_x1);
			       $('#cia_2').text(cia_x2);
			       $('#cia_3').text(cia_x4);
			       $('#cia_4').text(cia_x5);
			       $('#cia_5').text(cia_x6);
			       $('#cia_6').text(cia_x7);
			       $('#cia_7').text(cia_x11);
			       $('#cia_8').text(cia_x12);
			       $('#cia_9').text(cia_x14);
			       $('#cia_10').text(cia_x16);
			    if(value.activado=='S' && value.tipo_conductor=='B'){
			    		
			    		if(value.activado_conductor=='S'){
			    			$('#_'+value.id).addClass('conductor');
			    			control_conductor=true;
			    		}else{
			    			control_conductor=false;
			    			$('#_'+value.id).removeClass('conductor	');
			    		}
        			$('#'+value.id).show();
        			
        			if(value.cargo_id==9){
        				$('#_'+value.id).removeClass('voluntario');
        				$('#_'+value.id).removeClass('comandante');
        				$('#_'+value.id).removeClass('teniente');
        				$('#_'+value.id).removeClass('inspectores');
        				$('#_'+value.id).addClass('capitan');
        			}else if(value.cargo_id== 5 || value.cargo_id== 6 || value.cargo_id== 7 || value.cargo_id== 8 ){
        				$('#_'+value.id).removeClass('voluntario');
        				$('#_'+value.id).removeClass('comandante');
        				$('#_'+value.id).removeClass('capitan');
        				$('#_'+value.id).removeClass('inspectores');
        				$('#_'+value.id).addClass('teniente');
        			}else if(value.cargo_id== 13 || value.cargo_id== 14 || value.cargo_id== 15){
        				$('#_'+value.id).removeClass('voluntario');
        				$('#_'+value.id).removeClass('capitan');
        				$('#_'+value.id).removeClass('teniente');
        				$('#_'+value.id).removeClass('inspectores');
        				$('#_'+value.id).addClass('comandante');
        			}else if(value.cargo_id == 17){
        				$('#_'+value.id).removeClass('capitan');
        				$('#_'+value.id).removeClass('comandante');
        				$('#_'+value.id).removeClass('teniente');
        				$('#_'+value.id).removeClass('voluntario');
        				$('#_'+value.id).addClass('inspectores');
        			}
        			else{
        				$('#_'+value.id).removeClass('capitan');
        				$('#_'+value.id).removeClass('comandante');
        				$('#_'+value.id).removeClass('teniente');
        				$('#_'+value.id).removeClass('inspectores');
        				$('#_'+value.id).addClass('voluntario');
        			}
        				
        			switch (value.cia_id) {
						case 1:
							if(control_conductor==false){
						    	cia_x1 +=1;
							}
						    $('#cia_1').text(cia_x1);
						    break;
						case 2:
						    if(control_conductor==false){
						    	cia_x2 +=1;
							}
						    $('#cia_2').text(cia_x2);
						    break;
						case 3:
						    if(control_conductor==false){
						    	cia_x4 +=1;
							}
						    $('#cia_3').text(cia_x4);
						    break;
						case 4:
						    if(control_conductor==false){
						    	cia_x5 +=1;
							}
						    $('#cia_4').text(cia_x5);
						    break;
						case 5:
						    if(control_conductor==false){
						    	cia_x6 +=1;
							}
						    $('#cia_5').text(cia_x6);
						    break;
						case 6:
						    if(control_conductor==false){
						    	cia_x7 +=1;
							}
						    $('#cia_6').text(cia_x7);
						    break;
						case 7:
						    if(control_conductor==false){
						    	cia_x11 +=1;
							}
						    $('#cia_7').text(cia_x11);
						    break;
						case 8:
						    if(control_conductor==false){
						    	cia_x12 +=1;
							}
						    $('#cia_8').text(cia_x12);
						    break;
						case 9:
						    if(control_conductor==false){
						    	cia_x14 +=1;
							}
						    $('#cia_9').text(cia_x14);
						    break;
						case 10:
						    if(control_conductor==false){
						    	cia_x16 +=1;
							}
						    $('#cia_10').text(cia_x16);
					}
        		}else{
        			$('#'+value.id).hide();
        			//$('#__'+value.id).timer('reset');
        		}
        		});
            }
        });
    }

    function getActivadosCBI(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});	
    $.ajax({
        url : "{{ URL::route('visor.vol') }}",
        success : function(data){

					var cia_xx=0;
        		
        		$.each( data, function( key, value ) {

        			var control_conductor=false;
			       $('#cia_11').text(cia_xx);
			    if(value.activado_cbi=='S'){
			    		
        			$('#x_'+value.id).show();
        			
        			if(value.cargo_id==9){
        				$('#x__'+value.id).removeClass('voluntario');
        				$('#x__'+value.id).removeClass('comandante');
        				$('#x__'+value.id).removeClass('teniente');
        				$('#x__'+value.id).removeClass('inspectores');
        				$('#x__'+value.id).addClass('capitan');
        			}else if(value.cargo_id== 5 || value.cargo_id== 6 || value.cargo_id== 7 || value.cargo_id== 8 ){
        				$('#x__'+value.id).removeClass('voluntario');
        				$('#x__'+value.id).removeClass('comandante');
        				$('#x__'+value.id).removeClass('capitan');
        				$('#x__'+value.id).removeClass('inspectores');
        				$('#x__'+value.id).addClass('teniente');
        			}else if(value.cargo_id== 13 || value.cargo_id== 14 || value.cargo_id== 15){
        				$('#x__'+value.id).removeClass('voluntario');
        				$('#x__'+value.id).removeClass('capitan');
        				$('#x__'+value.id).removeClass('teniente');
        				$('#x__'+value.id).removeClass('inspectores');
        				$('#x__'+value.id).addClass('comandante');
        			}else if(value.cargo_id == 17){
        				$('#x__'+value.id).removeClass('capitan');
        				$('#x__'+value.id).removeClass('comandante');
        				$('#x__'+value.id).removeClass('teniente');
        				$('#x__'+value.id).removeClass('voluntario');
        				$('#x__'+value.id).addClass('inspectores');
        			}
        			else{
        				$('#x__'+value.id).removeClass('capitan');
        				$('#x__'+value.id).removeClass('comandante');
        				$('#x__'+value.id).removeClass('teniente');
        				$('#x__'+value.id).removeClass('inspectores');
        				$('#x__'+value.id).addClass('voluntario');
        			}
						    cia_xx +=1;
							
						    $('#cia_11').text(cia_xx);
					
        		}else{
        			$('#x_'+value.id).hide();
        			//$('#__'+value.id).timer('reset');
        		}
        		});
            }
        });
    }


    function getUnidades(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});
    		
    $.ajax({
    	contentType: "application/json; charset=utf-8",
        url : "{{ URL::route('visor.cuartel') }}",
        success : function(data){
        		$.each( data, function( key, value ) {
        			var a = $('#'+value.id2).data('estado');
        			
        			if(a === undefined || a === null){
  						$('#'+value.id2).data('estado',value.activacion);
					}else if(a==value.activacion){
						
					}else{
						
						var tono_activacion= $( "#tono_activacion option:selected" ).val();
						if(tono_activacion=='si'){
							//$('#tono').get(0).play();
							document.getElementById("tono").play().catch(function() {
    						console.log("a");
							});
						}
						$('#'+value.id2).data('estado',value.activacion).addClass('parpadea');
						
						$('#'+value.id2).click(function(e) {  
      						$(this).removeClass('parpadea');
    					});
					}

        			if(value.activacion=='S'){
        				$('#'+value.id2).css('background-color', '#00FF00');
        				$('#'+value.id2).data('conductor',value.conductor);
        				
        			}else{
        				$('#'+value.id2).css('background-color', 'red');
        			}
        			
        		});
            }
        });
    }
    var flag_x=false;
    var audios = [];
	var index =0;
	var tono = [];
	var flag_rescate=false;
	function tocar(t){
		index=0;
		audios = [];
		tono = [];
    	for (var i = 0; i < t.length; i++) {

    			var audio =document.getElementById(t[i]);
			    audios.push(audio);
			    if(flag_rescate ==true){

			    	if(t[i]=='cuartel_2Rx'){
			    		t[i]='cuartel_2x';
			    	}
			    	if(t[i]=='cuartel_6Rx'){
			    		t[i]='cuartel_6x';
			    	}
			    	if(t[i]=='cuartel_11Rx'){
			    		t[i]='cuartel_11x';
			    	}
			    	if(t[i]=='cuartel_14Rx'){
			    		t[i]='cuartel_14x';
			    	}
			    }
			    tono.push(t[i]); 	
    	}
    	flag_rescate=false;
    	StartPlayingAll();
    	flag_x=false;

    }

	function playNext(index) {

		var c1 = tono[index];
		var flag_tono=false; 
		var flag_tono2=false; 
		if(tono_select=='all'){
			if(flag_tono==false){
				audios[index].play();
			}	
		}else if(tono[index]==tono_select){
			audios[index].play();
		}else if(c1.split('_')[0]=='tono'){	
			if(flag_tono2==false){
				audios[index].play();
			}
		}else{

			audios[index].play();
			audios[index].muted=true;
		}
	    $(audios[index]).bind("ended", function(){		
	        index++;
	        if(index < audios.length){
	            playNext(index);          
	        }else{
	        	if(tono_select=='all'){
					window.location.href='volActivos?x=1&c='+tono_select+'&tono='+t_activacion;
             	}else{
					window.location.href='volActivos?x=1&c='+tono_select.split('_')[1]+'&tono='+t_activacion;
             	}
             	
			}

	    });

	}

	function StartPlayingAll() {


		if(tono_select=='all'){
			audios[index].play();
		}else if(tono[index]==tono_select){
			audios[index].play();
		}else{
			audios[index].play();
			audios[index].muted=true;
		}
   		
        $(audios[index]).bind("ended", function(){
		
             index = index + 1;
             if(index < audios.length){
                playNext(index);          
             }
             else{
             	if(tono_select=='all'){
             		window.location.href='volActivos?x=1&c='+tono_select+'&tono='+t_activacion;
             	}else{
             		window.location.href='volActivos?x=1&c='+tono_select.split('_')[1]+'&tono='+t_activacion;
             	}
             		
			}
                    
        });
	}

    function getTonos(){
        	$.ajaxSetup({
        		headers: {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        			}
    			});
		    	if(tono_select=='all'){
		    		var urlx="{{ URL::route('visor.evento') }}";
		    	}else{
		    		var url3 = "{{ URL::route('visor.mytono','N') }}";
					var urlx = url3.replace('N',tono_select);
		    	}	
	    	$.ajax({
	    	contentType: "application/json; charset=utf-8",
	        url : urlx,
	        success : function(data){
	        		var t = [];
	        		var ind=0;
	        		$.each( data, function( key, value ) {
	        			//console.log(data);	
	        			var a = $('#'+value.nombre).data('estado');
	        			
	        			if(a === undefined || a === null){
	  						$('#'+value.nombre).data('estado',value.estado);
						}else if(a==value.estado){
							
						}else{
							t[ind]=value.nombre;						
							ind++;
							$('#'+value.nombre).data('estado',value.estado);						
						}
	        				
	        		});
	        		if(t.indexOf('tono_rescate')>0){
	        			flag_rescate=true;
	        			if(t.indexOf('cuartel_2x')>=0){
	        				var a =t.indexOf('cuartel_2x');
	        				t[a]='cuartel_2Rx';
	        			}
	        			if(t.indexOf('cuartel_6x')>=0){
	        				var b =t.indexOf('cuartel_6x');
	        				t[b]='cuartel_6Rx';
	        			}
	        			if(t.indexOf('cuartel_11x')>=0){
	        				var c =t.indexOf('cuartel_11x');
	        				t[c]='cuartel_11Rx';
	        			}
	        			if(t.indexOf('cuartel_14x')>=0){
	        				var d =t.indexOf('cuartel_14x');
	        				t[d]='cuartel_14Rx';
	        			}
	        		}

	        		//console.log(t);
	        		if(t.length>0){
	        			flag_x=true;
	        			tocar(t);
	        		}
	        		
	            }
	        });

    }

    setInterval(getUnidades, 3000);
    setInterval(getActivados, 3000);
   // setInterval(getActivadosCBI, 3000);
    if(flag_x==false){
    setInterval(getTonos, 4000);
	}
});
   
</script>
@endsection