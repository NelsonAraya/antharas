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

</style>
@endsection
@section('content')
<div class="form-group row">
	<div class="col-md-1">
		<a id="btn" href="#" class="btn btn-info" role="button">Ver Unidades</a>
	</div>
</div>	
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
									  	<b>
									    <a id="pop_{{ $usu->id }}" href="javascript://" 
									    data-toggle="popover" data-trigger="focus"
									    data-content="<b>Rol: </b> {{ $usu->rol }} <br>
									    <b>Nombre: </b>{{ $usu->nombreSimple() }} <br> <b>Cargo: </b> {{ $usu->cargo->nombre }}" 
									    data-html="true"><span class="glyphicon glyphicon-search"></span>
										</a>
										</b>
									 
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
									<div id="{{ $mat->id }}" class="panel panel-default un" style="width: 100%; height: 50px; cursor: pointer;">
									  	<b>
									    {{ $mat->clave }}
									    <a id="pop_{{ $mat->id }}" href="#" data-toggle="popover" data-trigger="focus"
									    data-content="Sin Datos" data-html="true"><span class="glyphicon glyphicon-search"></span></a>
										</b>
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

@endsection
@section('js')
<script src="{{ asset('js/timer.jquery.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		@auth
	    	@if(Auth::user()->cargo_id == 24)

				$(document).on('dblclick','.op',function(e){
					
					var flag = true;
					if (e.target !== this){
						flag = false;  
					}else{
						flag= true;
					}

					if(flag){	
					var str = this.id;
				    var res = str.slice(1);
				    var url = "{{ URL::route('visor.activacion',['vol','N']) }}";
				    var url2 = url.replace('vol',res);
	 				$.ajaxSetup({
	        			headers: {
	            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        			}
	    			});
	    		
				    $.ajax({
				        url : url2,
				        success : function(data){
				        		
				        		alert("Usuario Desactivado");
				        		
				            }
				        });
					
					}
				})

				$(document).on('dblclick','.un',function(e){

					var flag = true;
					if (e.target !== this){
						flag = false;  
					}else{
						flag= true;
					}
					var str = this.id;
					var conductor = $(this).data('conductor');
				    var url = "{{ URL::route('visor.unidad',['usu','uni','N']) }}";
				    var url3 = url.replace('usu',conductor).replace('uni',str);
				    console.log($(this).hasClass("parpadea"));
				    if('rgb(0, 255, 0)' === $(this).css("background-color") ){
				    	console.log($(this).hasClass("parpadea"));
				    	if(flag){
		 				$.ajaxSetup({
		        			headers: {
		            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        			}
		    			});
		    		
					    $.ajax({
					        url : url3,
					        success : function(data){
					        		
					        		alert("Unidad Desactivada");
					        		
					            }
					        });
						}
				    }
				})
			@endif
    	@endauth

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
			    if(value.activado=='S'){
			    		
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
							if(control_conductor=false){
						    	cia_x1 +=1;
							}
						    $('#cia_1').text(cia_x1);
						    break;
						case 2:
						    if(control_conductor=false){
						    	cia_x2 +=1;
							}
						    $('#cia_2').text(cia_x2);
						    break;
						case 3:
						    if(control_conductor=false){
						    	cia_x4 +=1;
							}
						    $('#cia_3').text(cia_x4);
						    break;
						case 4:
						    if(control_conductor=false){
						    	cia_x5 +=1;
							}
						    $('#cia_4').text(cia_x5);
						    break;
						case 5:
						    if(control_conductor=false){
						    	cia_x6 +=1;
							}
						    $('#cia_5').text(cia_x6);
						    break;
						case 6:
						    if(control_conductor=false){
						    	cia_x7 +=1;
							}
						    $('#cia_6').text(cia_x7);
						    break;
						case 7:
						    if(control_conductor=false){
						    	cia_x11 +=1;
							}
						    $('#cia_7').text(cia_x11);
						    break;
						case 8:
						    if(control_conductor=false){
						    	cia_x12 +=1;
							}
						    $('#cia_8').text(cia_x12);
						    break;
						case 9:
						    if(control_conductor=false){
						    	cia_x14 +=1;
							}
						    $('#cia_9').text(cia_x14);
						    break;
						case 10:
						    if(control_conductor=false){
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

        			var a = $('#'+value.id).data('estado');
        			
        			if(a === undefined || a === null){
  						$('#'+value.id).data('estado',value.activacion);
					}else if(a==value.activacion){
						
					}else{
						//document.getElementById('tono').play();
						$('#tono').get(0).play();
						$('#'+value.id).data('estado',value.activacion).addClass('parpadea');
						
						$('#'+value.id).click(function(e) {  
      						$(this).removeClass('parpadea');
    					});
					}

        			if(value.activacion=='S'){
        				$('#'+value.id).css('background-color', '#00FF00');
        				$('#'+value.id).data('conductor',value.conductor);
        				$('#pop_'+value.id).attr('data-content','<b>Conductor:</b> '+value.usu+'<br><b>Dotacion:</b> '+value.usucia +'<br><b>Hora Activacion:</b> '+value.hora);
        			}else{
        				$('#'+value.id).css('background-color', 'red');
        				$('#pop_'+value.id).attr('data-content','<b>Desactivado :'+value.hora+'</b>');
        			}
        			
        		});
            }
        });
    }
    setInterval(getUnidades, 3000);
    setInterval(getActivados, 3000);
});
   
</script>
@endsection