@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">HOME</div>
            <div class="panel-body">
                Bienvenido a ANTHARAS sistema ONLINE PARA EL {{config('app.bombero')}}
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
                <br>
                Mi Activacion en <b>CUARTEL GENERAL</b>
                <br>
               <a @if($usu->activado_cbi=='S' OR $usu->activado=='S') 
                        href="#"
                        disabled   
                        @else 
                        href="{{ route('home.activacionCBI',[$usu->getHashId(),'S']) }}" 
                        @endif class="btn btn-success" role="button">Activo</a>
                    <a @if($usu->activado_cbi =='S') 
                        href="{{ route('home.activacionCBI',[$usu->getHashId(),'N']) }}" 
                        @else
                        href="#"
                        disabled
                        @endif class="btn btn-danger" role="button">Inactivo</a>          
            </div>
        </div>
    </div>
</div>
@endsection
