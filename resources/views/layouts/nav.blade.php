<nav class="navbar navbar-default navbar-static-top">
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
                <li class="@if( Route::currentRouteName()=='activacion.index')active  @endif"><a href="{{ route('activacion.index') }}">Activacion</a></li>   
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