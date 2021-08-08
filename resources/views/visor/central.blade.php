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
<audio id="tono" src="{{ asset('sonidos/evento.ton') }}" preload="auto"></audio>
<div id="tabla_uni" class="table-responsive col-md-12">
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
						
						document.getElementById("tono").play().catch(function() {
    						console.log("a");
						});

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

    setInterval(getUnidades, 3000);

});
   
</script>
@endsection