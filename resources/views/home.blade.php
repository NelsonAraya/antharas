@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">HOME</div>
            <div class="panel-body">
                Bienvenido a ANTHARAS sistema ONLINE PARA LOS CUERPOS DE BOMBEROS
                <br>
                <br>
                @if($usu->cia_id!=11 && $usu->operativo =='S')
                Mi Activacion en <b>CUARTEL</b> 
                    <br>
                        <a @if($usu->activado=='S' OR $usu->activado_cbi=='S') 
                        	href="#"
                        	disabled   
                        	@else 
                        	href="{{ route('home.activacion',[$usu->getHashId(),'S']) }}" 
                        	@endif class="btn btn-success" role="button">Activo</a>
        				<a @if($usu->activado =='S') 
        					href="{{ route('home.activacion',[$usu->getHashId(),'N']) }}" 
        					@else
        					href="#"
        					disabled
        					@endif class="btn btn-danger" role="button">Inactivo</a>
                     @else
                        <span><b>USTED NO ES OPERATIVO NO PUEDE ACTIVARSE EN CUARTEL</b></span>       
                     @endif
                    @if($usu->cargo_id ==13 || $usu->cargo_id ==14 || $usu->cargo_id ==15)
                    <br>
                    <br>
                    <div class="alert alert-warning">
                            <b>Version 1.0</b> <b>CAPITAN DE GUARDIA</b> Actualmente modulo se encuentra operativo y bajo constante monitoreo en caso de alguna 
                             incidencia favor de comunicarlo al equipo de Desarrollo</b>
                            <br>
                            <br>
                            atte. <b>Equipo Antharas</b>
	                </div>
                        COMANDANTE DE  <b>GUARDIA</b> 
                            <br>
                                <a @if($usu->comandante_guardia=='S') 
                                    href="#"
                                    disabled   
                                    @else 
                                    href="{{ route('home.activacionComandante',[$usu->getHashId(),'S']) }}" 
                                    @endif class="btn btn-success" role="button">Comandante de Guardia</a>
                    @endif                   
                    @if($usu->cargo_id ==9)
                    <br>
                    <br> 
                    <div class="alert alert-warning">
                             <b>Version 1.0</b> <b>CAPITAN DE GUARDIA</b> Actualmente modulo se encuentra operativo y bajo constante monitoreo en caso de alguna 
                             incidencia favor de comunicarlo al equipo de Desarrollo</b>
                            <br>
                            <br>
                            atte. <b>Equipo Antharas</b>
	                </div>
                        CAPITAN DE  <b>GUARDIA</b> 
                            <br>
                                <a @if($usu->capitan_guardia=='S') 
                                    href="#"
                                    disabled   
                                    @else 
                                    href="{{ route('home.activacionCapitan',[$usu->getHashId(),'S']) }}" 
                                    @endif class="btn btn-success" role="button">Capitan de Guardia</a>
                    @endif
                    


                    @if($usu->cargo_id ==24 || $usu->cargo_id ==25)
                    <br>
                    <br> 
                    <div class="alert alert-warning">
                             <b>Version 1.0</b> <b>OPERADOR DE TURNO</b> Actualmente modulo se encuentra operativo y bajo constante monitoreo en caso de alguna 
                             incidencia favor de comunicarlo al equipo de Desarrollo</b>
                            <br>
                            <br>
                            atte. <b>Equipo Antharas</b>
	                </div>
                        OPERADOR DE  <b>TURNO</b> 
                            <br>
                                <a @if($usu->operador_activo=='S') 
                                    href="#"
                                    disabled   
                                    @else 
                                    href="{{ route('home.activacionOperador',[$usu->getHashId(),'S']) }}" 
                                    @endif class="btn btn-success" role="button">Operador en Turno</a>
                    @endif




                     <!-- 
                    Mi Activacion en <b>CUARTEL GENERAL</b>
                    <br>
                   <a @if($usu->activado_cbi=='S' OR $usu->activado=='S') 
                            href="#"
                            disabled   
                            @else 
                            href="{{  route('home.activacionCBI',[$usu->getHashId(),'S'])  }}" 
                            @endif class="btn btn-success" role="button">Activo</a>
                        <a @if($usu->activado_cbi =='S') 
                            href="{{  route('home.activacionCBI',[$usu->getHashId(),'N'])  }}" 
                            @else
                            href="#"
                            disabled
                            @endif class="btn btn-danger" role="button">Inactivo</a>          
                        -->
            </div>
        </div>
         <div class="panel panel-danger">
            <div class="panel-heading">ANTHARAS INFORMA</div>
                 <div class="panel-body">
                    El Staff De desarollo <b>ANTHARAS</b> junto con la <b>Comandancia</b> del <b>{{ str_replace('_',' ',env('APP_NAMECB')) }} </b> les Informa.
                         <img src="{{ asset('img/foto1.jpg') }}" class="img-responsive" alt="Responsive image">
                          <!-- 
                           <ol>
                              <li>Descontaminación de calzado y lavado de manos con agua y jabón al menos por 20 segundos.</li>
                              <li>Descontamina las superficies de contacto y mantén distancia de al menos 1 metro siempre. </li>
                              <li>Prepara tu Epp para responder a emergencias y no olvides llevar la protección biológica. (Mascarilla, protección ocular y guantes de látex) </li>
                            </ol>
                            De todos depende mantenernos sanos y ganarle al <b>Covid-19.</b>  La operatividad institucional y de vuestra compañía es muy importante!!!
                            -->
                 </div>
        </div>
    </div>
</div>
@endsection
