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
					<th  style="width: 10%; text-align: center; border: 1px solid green; background-color: white;">Cia N°{{ $row->numero }}
					Activos : <span id="cia_{{ $row->id }}"></span>
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
						@foreach($row->usuarios as $usu)
							@if($usu->estado=='A')
							<tr>
								<td id="{{ $usu->id }}" style=" width: 10%; display: none;">
									<div id="_{{ $usu->id }}" class="panel panel-default">
									  <div class="panel-body">
									  	<b>
									    {{ $usu->rol }}
									    <a id="pop_{{ $usu->id }}" href="javascript://" data-toggle="popover" 
									    	data-trigger="focus"
									    data-content="<b>Nombre: </b>{{ $usu->nombreSimple() }} <br> <b>Cargo: </b> {{ $usu->cargo->nombre }}" 
									    data-html="true"><span class="glyphicon glyphicon-search"></span></a>
										</b>
									  </div>
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
					<th  style="width: 10%; text-align: center; border: 1px solid green; background-color: white;">CBI
					</th>
					@else
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
							<tr>
								<td style=" width: 10%;">
									<div id="{{ $mat->id }}" class="panel panel-default">
									  <div class="panel-body">
									  	<b>
									    {{ $mat->clave }}
									    <a id="pop_{{ $mat->id }}" href="#" data-toggle="popover" data-trigger="focus"
									    data-content="Sin Datos" data-html="true"><span class="glyphicon glyphicon-search"></span></a>
										</b>
									  </div>
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

@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function() {
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

        			$('#'+value.id).show();
        			if(value.cargo_id==5){
        				$('#_'+value.id).css('background-color', '#F7F319');
        			}else if(value.cargo_id== 6 || value.cargo_id== 7 || value.cargo_id== 8 || value.cargo_id== 9 ){
        				$('#_'+value.id).css('background-color', 'red');
        			}else if(value.cargo_id== 13 || value.cargo_id== 14 || value.cargo_id== 15){
        				$('#_'+value.id).css('background-color', '#2B79EA');
        			}
        			else{
        				$('#_'+value.id).css('background-color', '#00FF00');
        			}
        				
        			switch (value.cia_id) {
						case 1:
						    cia_x1 +=1;
						    $('#cia_1').text(cia_x1);
						    break;
						case 2:
						    cia_x2 +=1;
						    $('#cia_2').text(cia_x2);
						    break;
						case 3:
						    cia_x4 +=1;
						    $('#cia_3').text(cia_x4);
						    break;
						case 4:
						    cia_x5 +=1;
						    $('#cia_4').text(cia_x5);
						    break;
						case 5:
						    cia_x6 +=1;
						    $('#cia_5').text(cia_x6);
						    break;
						case 6:
						    cia_x7 +=1;
						    $('#cia_6').text(cia_x7);
						    break;
						case 7:
						    cia_x11 +=1;
						    $('#cia_7').text(cia_x11);
						    break;
						case 8:
						    cia_iqq +=1;
						    $('#cia_8').text(cia_x12);
						    break;
						case 9:
						    cia_x14 +=1;
						    $('#cia_9').text(cia_x14);
						    break;
						case 10:
						    cia_x16 +=1;
						    $('#cia_10').text(cia_x16);
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
        				$('#pop_'+value.id).attr('data-content','<b>Conductor:</b> '+value.usu+'<br><b>Dotacion:</b> '+value.usucia);
        			}else{
        				$('#'+value.id).css('background-color', 'red');
        				$('#pop_'+value.id).attr('data-content','<b>Sin Conductor</b>');
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