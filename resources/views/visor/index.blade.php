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
</style>
@endsection
@section('content')
	<a id="btn" href="#" class="btn btn-info btn-lg linea" role="button">Ver Unidades</a>
	@auth
		@if(Auth::user()->hasRole('tono'))
		<a id="btn_tono" href="#" class="btn btn-danger btn-lg linea" role="button">Consola de Tonos</a>
		@endif
	@endauth
<div id="tabla_vol" class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				@foreach($cia as $row)
					@if ($row->numero != 100)
					<th  style="width: 10%; text-align: center; border: 1px solid green; background-color: white;">Cia N°{{ $row->numero }} <br>
					En Cuartel : <span id="cia_{{ $row->id }}"></span>
					</th>
					@endif
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($cia as $row)
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
				@endforeach
			</tr>	
		</tbody>
	</table>   	
</div>
<audio id="tono" src="{{ asset('sonidos/evento.ton') }}" preload="auto"></audio>
<audio id="cuartel_1" src="{{ asset('sonidos/1.wav') }}" preload="auto"></audio>
<audio id="cuartel_2" src="{{ asset('sonidos/2.wav') }}" preload="auto"></audio>
<audio id="cuartel_4" src="{{ asset('sonidos/4.wav') }}" preload="auto"></audio>
<audio id="cuartel_5" src="{{ asset('sonidos/5.wav') }}" preload="auto"></audio>
<audio id="cuartel_6" src="{{ asset('sonidos/6.wav') }}" preload="auto"></audio>
<audio id="cuartel_7" src="{{ asset('sonidos/7.wav') }}" preload="auto"></audio>
<audio id="cuartel_11" src="{{ asset('sonidos/11.wav') }}" preload="auto"></audio>
<audio id="cuartel_12" src="{{ asset('sonidos/12.wav') }}" preload="auto"></audio>
<audio id="cuartel_14" src="{{ asset('sonidos/14.wav') }}" preload="auto"></audio>
<audio id="tono_estructural" src="{{ asset('sonidos/estructural.mp3') }}" preload="auto"></audio>
<audio id="tono_incendio" src="{{ asset('sonidos/incendio.mp3') }}" preload="auto"></audio>
<audio id="tono_rescate" src="{{ asset('sonidos/rescate.mp3') }}" preload="auto"></audio>
<div id="tabla_uni" class="table-responsive" style="display: none">
	<table class="table">
		<thead>
			<tr>
				@foreach($cia as $row)
					@if ($row->numero == 100)
					<th  style="width: 10px; text-align: center; border: 1px solid green; background-color: white;">CBI
					</th>
					@else
					<th  style="width: 10px; text-align: center; border: 1px solid green; background-color: white;">Cia N°{{ $row->numero }}</th>
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
@auth
@if(Auth::user()->hasRole('tono'))
<div id="tabla_tono" class="table-responsive" style="display: none">
	<table class="table">
		<thead>
			<tr>
				@foreach($cia as $row)
					@if ($row->numero != 100)
					<th  style="width: 10px; text-align: center; border: 1px solid green; background-color: white;">Cia N°{{ $row->numero }}
					</th>
					@endif
				@endforeach
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($cia as $row)
					@if ($row->numero != 100)
					<td>
						<a id="cuartel_{{ $row->numero }}" href="#" 
							class="btn btn-success btn-group btn-lg tono" role="button">
								Tono <span class="glyphicon glyphicon-bullhorn"></span>
							</a>
					</td>
					@endif
				@endforeach
			</tr>	
		</tbody>
	</table>
	<br>
	<div class="btn-group">
	  <a type="button" id="btn_estructural" class="btn btn-success tono2 btn-lg">ESTRUCTURAL</a>
	  <a type="button" id="btn_rescate" class="btn btn-success tono2 btn-lg">RESCATE</a>
	  <a type="button" id="btn_incendio" class="btn btn-success tono2 btn-lg">INCENDIO</a>
	</div>
	<br>
	<br>
	<a id="tono_cuartel" href="#" class="btn btn-primary btn-group btn-lg" role="button">
		<span class="glyphicon glyphicon-play"></span> Tocar
	</a>
</div>
@endif
@endauth	
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
@endsection
@section('js')
<script src="{{ asset('js/timer.jquery.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
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


    	$('.modal').on('hidden.bs.modal', function(){
    		 $("#modal .modal-body").html('');
		});

		function imageExists(url){

    		var image = new Image();

    		image.src = url;

		    if (!image.complete) {
		        return false;
		    }
		    else if (image.height === 0) {
		        return false;
		    }

    		return true;
		}

 		$( "#btn" ).click(function() {
 			if(document.getElementById('tabla_uni').style.display=="none"){
 				$("#tabla_vol").hide("slow");
 				$("#tabla_tono").hide("slow");
 				$("#tabla_uni").show("slow");
 				$(this).html("Ver Voluntarios");
 				$(this).removeClass( "btn-info" ).addClass( "btn-primary" );
 			}else{
 				$("#tabla_uni").hide("slow");
 				$("#tabla_tono").hide("slow");
 				$("#tabla_vol").show("slow");
 				$(this).html("Ver Unidades");
 				$(this).removeClass( "btn-primary" ).addClass( "btn-info" );
 			}
		});

		$( "#btn_tono" ).click(function() {
 			if(document.getElementById('tabla_tono').style.display=="none"){
 				$("#tabla_vol").hide("slow");
 				$("#tabla_uni").hide("slow");
 				$("#tabla_tono").show("slow");
 			}
		});
		@auth
			@if(Auth::user()->hasRole('tono'))

			$(".tono").on('click', function(event){
				if($(this).hasClass("btn-danger")){
		    		$(this).removeClass('btn-danger');
	        		$(this).addClass('btn-success');
        		}else{
        			$(this).removeClass('btn-success');
	        		$(this).addClass('btn-danger');
        		}
				
			});
			var flag="";
			$("#btn_estructural").on('click', function(event){
				if($(this).hasClass("btn-success")){
		    		$(this).removeClass('btn-success');
	        		$(this).addClass('btn-danger');
	        		flag='tono_estructural';
	        		$("#btn_incendio").removeClass('btn-danger');
	        		$("#btn_rescate").removeClass('btn-danger');
	        		$("#btn_rescate").addClass('btn-success');
	        		$("#btn_incendio").addClass('btn-success');
        		}else{
        			$(this).removeClass('btn-danger');
	        		$(this).addClass('btn-success');
        		}
				
			});

			$("#btn_rescate").on('click', function(event){
				if($(this).hasClass("btn-danger")){
		    		$(this).removeClass('btn-danger');
	        		$(this).addClass('btn-success');
        		}else{
        			flag="tono_rescate";
        			$(this).removeClass('btn-success');
	        		$(this).addClass('btn-danger');
	        		$("#btn_incendio").removeClass('btn-danger');
	        		$("#btn_estructural").removeClass('btn-danger');
	        		$("#btn_estructural").addClass('btn-success');
	        		$("#btn_incendio").addClass('btn-success');
        		}
				
			});

			$("#btn_incendio").on('click', function(event){
				if($(this).hasClass("btn-danger")){
		    		$(this).removeClass('btn-danger');
	        		$(this).addClass('btn-success');
        		}else{
        			flag="tono_incendio";
        			$(this).removeClass('btn-success');
	        		$(this).addClass('btn-danger');
	        		$("#btn_rescate").removeClass('btn-danger');
	        		$("#btn_estructural").removeClass('btn-danger');
	        		$("#btn_estructural").addClass('btn-success');
	        		$("#btn_rescate").addClass('btn-success');

        		}
				
			});


			$("#tono_cuartel").on('click', function(event){
				 var opcion = confirm("¿Seguro en Enviar Tonos de Cuartel?");
				  if (opcion == true) {
			    		 $(".tono").each(function(){
		    				if($(this).hasClass("btn-danger")){
		    					var id = this.id
					    		var url = "{{ URL::route('visor.tono','N') }}";
								var url2 = url.replace('N',id);

								$.ajaxSetup({
							    	headers: 
							    	{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
							    			});
					    		
								$.ajax({
									url : url2,
									success : function(data){
										/*
			    		 				$(".tono").each(function(){
											if(this.id==data){
												$(this).removeClass('btn-danger');
		        								$(this).addClass('btn-success');
											}															
										});
										*/
									}
								});
		    				}
		  				});
							var url3 = "{{ URL::route('visor.tono','N') }}";
							var url4 = url3.replace('N',flag);

								$.ajaxSetup({
							    	headers: 
							    	{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
							    			});
					    		
								$.ajax({
									url : url4,
									success : function(data){
										/*
			    		 				$(".tono").each(function(){
											if(this.id==data){
												$(this).removeClass('btn-danger');
		        								$(this).addClass('btn-success');
											}															
										});
										*/
									}
								});					    		

			    	}
			});
			@endif
		 @endauth	

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

    function getActivados(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});	
    $.ajax({
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
    function getUnidades(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});
    		
    $.ajax({
        url : "{{ URL::route('visor.cuartel') }}",
        success : function(data){
        		$.each( data, function( key, value ) {
        			var a = $('#'+value.id2).data('estado');
        			
        			if(a === undefined || a === null){
  						$('#'+value.id2).data('estado',value.activacion);
					}else if(a==value.activacion){
						
					}else{
						//document.getElementById('tono').play();
						$('#tono').get(0).play();
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
    
    var audios = [];
	var index =0;
	var tono = [];
	function tocar(t){
		index=0;
		audios = [];
		tono = [];
    	for (var i = 0; i < t.length; i++) {

    		var audio =document.getElementById(t[i]);
		    audios.push(audio);
		    tono.push(t[i]); 	
    	}
    	StartPlayingAll();
    }

	function playNext(index) {
		@auth
			@if(Auth::user()->hasRole('tono'))		
				$(".tono").each(function(){
					if(this.id==tono[index]){
				    $(this).addClass('parpadea');
					}															
				});
				$(".tono2").each(function(){
					var n1= this.id;
					var n2 = tono[index]; 
					if(n1.split('_')[1]==n2.split('_')[1]){
				    $(this).addClass('parpadea');
					}															
				});
			@endif
		@endauth
	    audios[index].play();
	    $(audios[index]).bind("ended", function(){
	    @auth
			@if(Auth::user()->hasRole('tono'))
		    	$(".tono").each(function(){
					if(this.id==tono[index]){
				    $(this).removeClass('parpadea');
				    $(this).removeClass('btn-danger');
				    $(this).addClass('btn-success');
					}															
				});
				$(".tono2").each(function(){
					var n1= this.id;
					var n2 = tono[index]; 
					if(n1.split('_')[1]==n2.split('_')[1]){
				    $(this).removeClass('parpadea');
				    $(this).removeClass('btn-danger');
				    $(this).addClass('btn-success');
					}															
				});
			@endif
		@endauth		
	        index++;
	        if(index < audios.length){
	            playNext(index);          
	        }
	    });

	}

	function StartPlayingAll() {

		@auth
			@if(Auth::user()->hasRole('tono'))		
				$(".tono").each(function(){
					if(this.id==tono[index]){
				    $(this).addClass('parpadea');
					}															
				});
			@endif
		@endauth
   		audios[index].play();
        $(audios[index]).bind("ended", function(){
		@auth
			@if(Auth::user()->hasRole('tono'))
		    	$(".tono").each(function(){
					if(this.id==tono[index]){
				    $(this).removeClass('parpadea');
				    $(this).removeClass('btn-danger');
				    $(this).addClass('btn-success');
					}															
				});
			@endif
		@endauth		
             index = index + 1;
             if(index < audios.length){
                playNext(index);          
             }                      
        });
	}

    function getTonos(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});
    		
    $.ajax({
        url : "{{ URL::route('visor.evento') }}",
        success : function(data){
        		var t = [];
        		var ind=0;
        		$.each( data, function( key, value ) {

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
        		if(t.length>0){
        			tocar(t);
        		}
            }
        });
    }
    setInterval(getUnidades, 3000);
    setInterval(getActivados, 3000);
    setInterval(getTonos, 4000);
});
   
</script>
@endsection