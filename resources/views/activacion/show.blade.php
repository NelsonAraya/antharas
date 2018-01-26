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
<audio id="tono" src="{{ asset('sonidos/evento.ton') }}" preload="auto"></audio>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				@foreach($cia as $row)
					<th  style="width: 10%; text-align: center; border: 1px solid green; background-color: white;">Cia N°{{ $row->numero }}</th>
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
 
    	$('[data-toggle="popover"]').popover();  

    function getActivados(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});	
    $.ajax({
        url : "{{ URL::route('activacion.vista') }}",
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

    setInterval(getActivados, 3000);
});
   
</script>
@endsection