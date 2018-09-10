@extends('layouts.main')
@section('content')
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				@foreach($cia as $row)
					<th  style="width: 10%; text-align: center; border: 1px solid green; background-color: white;">Cia N°{{ $row->numero }}
					Activos : <span id="cia_{{ $row->id }}"></span>
					</th>
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
								<td style=" width: 10%;">
									<div id="{{ $usu->id }}" class="panel panel-default">
									  <div class="panel-body">
									  	<b>
									    {{ $usu->rol }}
									    <a id="pop_{{ $usu->id }}" data-toggle="popover" data-trigger="focus"
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

@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function() {
 
    	$('[data-toggle="popover"]').popover();  
    	
    	var cia1=0;
		var cia2=0;
		var cia4=0;
		var cia5=0;
		var cia6=0;
		var cia7=0;
		var cia11=0;
		var cia12=0;
		var cia14=0;
		var cia16=0;

       $('#cia_1').text(cia1);
       $('#cia_2').text(cia2);
       $('#cia_3').text(cia4);
       $('#cia_4').text(cia5);
       $('#cia_5').text(cia6);
       $('#cia_6').text(cia7);
       $('#cia_7').text(cia11);
       $('#cia_8').text(cia12);
       $('#cia_9').text(cia14);
       $('#cia_10').text(cia16);

    function getActivados(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});	
    $.ajax({
        url : "{{ URL::route('emergencia.vista') }}",
        success : function(data){

        			var cia1=0;
					var cia2=0;
					var cia4=0;
					var cia5=0;
					var cia6=0;
					var cia7=0;
					var cia11=0;
					var cia12=0;
					var cia14=0;
					var cia16=0;
        		
        		$.each( data, function( key, value ) {

        			
			       $('#cia_1').text(cia1);
			       $('#cia_2').text(cia2);
			       $('#cia_3').text(cia4);
			       $('#cia_4').text(cia5);
			       $('#cia_5').text(cia6);
			       $('#cia_6').text(cia7);
			       $('#cia_7').text(cia11);
			       $('#cia_8').text(cia12);
			       $('#cia_9').text(cia14);
			       $('#cia_10').text(cia16);

        			if(value.activado=='S'){
        				$('#'+value.id).css('background-color', '#00FF00');

        				switch (value.cia_id) {
						    case 1:
						        cia1 +=1;
						        $('#cia_1').text(cia1);
						        break;
						    case 2:
						        cia2 +=1;
						        $('#cia_2').text(cia2);
						        break;
						    case 3:
						        cia4 +=1;
						        $('#cia_3').text(cia4);
						        break;
						    case 4:
						        cia5 +=1;
						        $('#cia_4').text(cia5);
						        break;
						    case 5:
						        cia6 +=1;
						        $('#cia_5').text(cia6);
						        break;
						    case 6:
						        cia7 +=1;
						        $('#cia_6').text(cia7);
						        break;
						    case 7:
						        cia11 +=1;
						        $('#cia_7').text(cia11);
						    case 8:
						        cia12 +=1;
						        $('#cia_8').text(cia12);
						        break;
						    case 9:
						        cia14 +=1;
						        $('#cia_9').text(cia14);
						        break;
						    case 10:
						        cia16 +=1;
						        $('#cia_10').text(cia16);
						}

        			}else{
        				$('#'+value.id).css('background-color', 'red');


        			}
        			
        		});
            }
        });
    }

    setInterval(getActivados, 3000);
});
   
</script>
@endsection