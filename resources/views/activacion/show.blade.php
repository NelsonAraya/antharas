@extends('layouts.main')

@section('content')
<audio id="tono" src="{{ asset('sonidos/tono.mp3') }}" preload="auto"></audio>
<table class="table">
	<thead>
		<tr>
			@foreach($cia as $row)
				<th  style="width: 7%;">{{ $row->numero }}</th>
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
						<td>
							<div id="{{ $mat->id }}" class="panel panel-default">
							  <div class="panel-body">
							  	<b>
							    {{ $mat->clave }}
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
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function() {

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
						document.getElementById('tono').play();
						$('#'+value.id).data('estado',value.activacion);
					}

        			if(value.activacion=='S'){
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