<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('home') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            @auth
            <ul class="nav navbar-nav">
                @if(Auth::user()->hasRole('rrhh'))
                  <li class="dropdown
                   @if(Route::currentRouteName()=='usuarios.index' OR 
                       Route::currentRouteName()=='usuarios.create' OR 
                       Route::currentRouteName()=='conductores.index' OR 
                       Route::currentRouteName()=='usuarios.edit' OR 
                       Route::currentRouteName()=='conductores.edit'   
                   )active @endif">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                      role="button" aria-haspopup="true" aria-expanded="false">RRHH
                       <span class="caret"></span>
                      </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('usuarios.index') }}">usuarios</a></li>
                      <li><a href="{{ route('conductores.index') }}">Conductores</a></li>
                    </ul>
                  </li>
                @endif
                @if(Auth::user()->hasRole('activacion'))
                  <li class="dropdown
                   @if( Route::currentRouteName()=='activacion.index' OR 
                        Route::currentRouteName()=='activacion.cuarteles')active  @endif">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                      role="button" aria-haspopup="true" aria-expanded="false">Activacion
                       <span class="caret"></span>
                      </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('activacion.index') }}">Activacion</a></li>   
                      <li><a href="{{ route('activacion.cuarteles') }}">Ver Activaciones</a></li>
                  
                    </ul>
                  </li>
                @endif
                @if(Auth::user()->hasRole('adminCBI'))
                  <li class="dropdown 
                  @if( Route::currentRouteName()=='material_mayor.index' OR 
                       Route::currentRouteName()=='material_mayor.create' OR 
                       Route::currentRouteName()=='material_mayor.edit')active  @endif">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                      role="button" aria-haspopup="true" aria-expanded="false">AdminCBI
                       <span class="caret"></span>
                      </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('material_mayor.index') }}">Agregar Mat. Mayor</a></li>   
                    </ul>
                  </li>
                @endif
                @if(Auth::user()->hasRole('adminCIA'))
                  <li class="dropdown
                  @if( Route::currentRouteName()=='cia.index') active @endif">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                      role="button" aria-haspopup="true" aria-expanded="false">AdminCIA
                       <span class="caret"></span>
                      </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('cia.index') }}">Ver Listado Cia</a></li>   
                    </ul>
                  </li>
                @endif
                @if(Auth::user()->hasRole('bitacora'))
                  <li class="dropdown 
                  @if( Route::currentRouteName()=='bitacora.index' OR 
                       Route::currentRouteName()=='bitacora.show' OR
                       Route::currentRouteName()=='bitacora.ver')active  @endif">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                      role="button" aria-haspopup="true" aria-expanded="false">Bitacoras
                       <span class="caret"></span>
                      </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('bitacora.index') }}">Listado Unidades</a></li>   
                    </ul>
                  </li>
                @endif
                @if(Auth::user()->hasRole('emergencia'))
                  <li class="dropdown
                  @if(Route::currentRouteName()=='emergencia.index' OR 
                      Route::currentRouteName()=='emergencia.create') active @endif">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                      role="button" aria-haspopup="true" aria-expanded="false">Emergencias
                       <span class="caret"></span>
                      </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('emergencia.index') }}">Ver Listado</a></li>   
                    </ul>
                  </li>
                @endif
                @if(Auth::user()->hasRole('partes'))
                  <li class="dropdown
                  @if(Route::currentRouteName()=='partesonline.index' OR 
                      Route::currentRouteName()=='partesonline.show' OR 
                      Route::currentRouteName()=='partesonline.lista') active @endif">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                      role="button" aria-haspopup="true" aria-expanded="false">Partes Online
                       <span class="caret"></span>
                      </a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('partesonline.index') }}">Ver / Ingresar</a></li>   
                    </ul>
                  </li>
                @endif          
            </ul>
            @endauth
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->nombreSimple() }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>