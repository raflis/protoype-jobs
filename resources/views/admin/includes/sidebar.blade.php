<div class="layoutNav shadow">
    <div class="nav-items">

        <div class="sidenav-menu-heading">Proyectos</div>
        <a class="nav-link @if(Route::currentRouteName()=="proyectos" || Route::currentRouteName()=="proyectos.index" || Route::currentRouteName()=="proyectos.show") active @endif" 
        href="{{ route('proyectos.index') }}">
            <i class="fas fa-tasks text-gray pr-1"></i> Proyectos
        </a>
        <a class="nav-link @if(Route::currentRouteName()=="componentes") active @endif" 
        href="{{ route('componentes') }}">
            <i class="fas fa-tasks text-gray pr-1"></i> Componentes
        </a>
        <a class="nav-link @if(Route::currentRouteName()=="funcionalidades") active @endif" 
        href="{{ route('funcionalidades') }}">
            <i class="fas fa-tasks text-gray pr-1"></i> Funcionalidades
        </a>




    </div>
    <div class="nav-footer py-4">
        <p>Logueado como:</p>
        <p>Dennis Ormeño</p>
    </div>
</div>