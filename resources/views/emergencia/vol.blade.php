@extends('layouts.main')
@section('content')
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
						@foreach($row->usuarios as $usu)
							@if($usu->estado=='A')
							<tr>
								<td style=" width: 10%;">
									<div id="{{ $usu->id }}" class="panel panel-default">
									  <div class="panel-body">
									  	<b>
									    {{ $usu->rol }}
									    <a id="pop_{{ $usu->id }}" href="#" data-toggle="popover" data-trigger="focus"
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

    function getActivados(){
        
        $.ajaxSetup({
        	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    	});	
    $.ajax({
        url : "{{ URL::route('emergencia.vista') }}",
        success : function(data){
        		$.each( data, function( key, value ) {

        			if(value.activado=='S'){
        				$('#'+value.id).css('background-color', '#00FF00');
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