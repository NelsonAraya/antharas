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

<div id="tabla_tono" class="table-responsive col-md-12">
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
						<a id="cuartel_{{ $row->numero }}x" href="#" 
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
	<div style="text-align: center;">
	  <a type="button" id="btn_estructural" class="btn btn-success tono2 btn-lg">ESTRUCTURAL</a>
	  <a type="button" id="btn_rescate" class="btn btn-success tono2 btn-lg">RESCATE</a>
	  <a type="button" id="btn_incendio" class="btn btn-success tono2 btn-lg">INCENDIO</a>
	  <a type="button" id="btn_hazmat" class="btn btn-success tono2 btn-lg">HAZMAT</a>
	  <a type="button" id="btn_otros" class="btn btn-success tono2 btn-lg">OTROS Y COM</a>
	</div>
	<br>
	<br>
	<div style="text-align: center;">
			<a id="tono_cuartel" href="#" class="btn btn-primary btn-lg" role="button" style="width: 300px;height: 50px">
		<span class="glyphicon glyphicon-play"></span> REPRODUCIR
	</a>
	</div>	
</div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/timer.jquery.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var flag_rescate=false;
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
	        		$("#btn_hazmat").removeClass('btn-danger');
	        		$("#btn_hazmat").addClass('btn-success');
					$("#btn_otros").removeClass('btn-danger');
	        		$("#btn_otros").addClass('btn-success');
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
	        		$("#btn_hazmat").removeClass('btn-danger');
	        		$("#btn_hazmat").addClass('btn-success');
	        		$("#btn_estructural").removeClass('btn-danger');
	        		$("#btn_estructural").addClass('btn-success');
	        		$("#btn_incendio").addClass('btn-success');
	        		$("#btn_otros").removeClass('btn-danger');
	        		$("#btn_otros").addClass('btn-success');
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
	        		$("#btn_hazmat").removeClass('btn-danger');
	        		$("#btn_hazmat").addClass('btn-success');
	        		$("#btn_otros").removeClass('btn-danger');
	        		$("#btn_otros").addClass('btn-success');
        		}
				
			});

			$("#btn_hazmat").on('click', function(event){
				if($(this).hasClass("btn-danger")){
		    		$(this).removeClass('btn-danger');
	        		$(this).addClass('btn-success');
        		}else{
        			flag="tono_hazmat";
        			$(this).removeClass('btn-success');
	        		$(this).addClass('btn-danger');
	        		$("#btn_rescate").removeClass('btn-danger');
	        		$("#btn_estructural").removeClass('btn-danger');
	        		$("#btn_estructural").addClass('btn-success');
	        		$("#btn_rescate").addClass('btn-success');
	        		$("#btn_incendio").removeClass('btn-danger');	        		
	        		$("#btn_incendio").addClass('btn-success');
	        		$("#btn_otros").removeClass('btn-danger');
	        		$("#btn_otros").addClass('btn-success');
        		}
				
			});

			$("#btn_otros").on('click', function(event){
				if($(this).hasClass("btn-danger")){
		    		$(this).removeClass('btn-danger');
	        		$(this).addClass('btn-success');
        		}else{
        			flag="tono_otros";
        			$(this).removeClass('btn-success');
	        		$(this).addClass('btn-danger');
	        		$("#btn_rescate").removeClass('btn-danger');
	        		$("#btn_estructural").removeClass('btn-danger');
	        		$("#btn_estructural").addClass('btn-success');
	        		$("#btn_rescate").addClass('btn-success');
	        		$("#btn_incendio").removeClass('btn-danger');	        		
	        		$("#btn_incendio").addClass('btn-success');
	        		$("#btn_hazmat").removeClass('btn-danger');
	        		$("#btn_hazmat").addClass('btn-success');
        		}
				
			});


			$("#tono_cuartel").on('click', function(event){
				var final = [];
				var ind=0;
				 var opcion = confirm("¿Seguro en Enviar Tonos de Cuartel?");
				  if (opcion == true) {
			    		 $(".tono").each(function(){
		    				if($(this).hasClass("btn-danger")){
		    					var id = this.id;
					    		var url = "{{ URL::route('visor.tono','N') }}";
								var url2 = url.replace('N',id);

								$.ajaxSetup({
							    	headers: 
							    	{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
							    			});
					    		
								$.ajax({
									url : url2,
									success : function(data){
										        			
										final[ind]=id;						
										ind++;						
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
	        			
										final[ind]=flag;						
										ind++;

										if(flag=='tono_rescate'){
											flag_rescate=true;
						        			if(final.indexOf('cuartel_2x')>=0){
						        				var a =final.indexOf('cuartel_2x');
						        				final[a]='cuartel_2Rx';
						        			}
						        			if(final.indexOf('cuartel_6x')>=0){
						        				var b =final.indexOf('cuartel_6x');
						        				final[b]='cuartel_6Rx';
						        			}
						        			if(final.indexOf('cuartel_11x')>=0){
						        				var c =final.indexOf('cuartel_11x');
						        				final[c]='cuartel_11Rx';
						        			}
						        			if(final.indexOf('cuartel_14x')>=0){
						        				var d =final.indexOf('cuartel_14x');
						        				final[d]='cuartel_14Rx';
						        			}
						        		}

					        			tocar(final);
									}
								});					    		
			    	}

			});

    	$('[data-toggle="popover"]').popover();  

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
    }

	function playNext(index) {

		audios[index].muted=true;		
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


				var c1 = tono[index];
					if(c1.split('_')[0]=='tono'){
						var r = confirm("Reproducir Tono Emergencia?");
						if(r==true){
							audios[index].muted=false;	
							audios[index].play();
						}
					}else{
						audios[index].play();
					}
	

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
	        }else{
				location.reload();    	
			}

	    });

	}

	function StartPlayingAll() {

			$(".tono").each(function(){
				if(this.id==tono[index]){
				    $(this).addClass('parpadea');
				}															
			});

			if(tono[index]=='tono_otros'){
				audios[index].muted=false;				
				audios[index].play();		
			}else{
				audios[index].muted=true;				
				audios[index].play();
			}		
   		
        $(audios[index]).bind("ended", function(){
		    	$(".tono").each(function(){
					if(this.id==tono[index]){
				    $(this).removeClass('parpadea');
				    $(this).removeClass('btn-danger');
				    $(this).addClass('btn-success');
					}															
				});		
             index = index + 1;
             if(index < audios.length){
                playNext(index);          
             }
             else{             
             	location.reload(); 	
			}
                    
        });
	}
});
   
</script>
@endsection