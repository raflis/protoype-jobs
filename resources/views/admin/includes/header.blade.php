<nav class="navbar fixed-top shadow justify-content-between">
    <div class="burger">
        <div class="linea1"></div>
        <div class="linea2"></div>
        <div class="linea3"></div>
    </div>
    <a href="" class="nav-brand">
        Administrador
    </a>
    <ul class="navbar-nav my-0 first">
        <li class="dropdown lifirst">
            <a class="btn-avatar dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="avatar" src="{{ asset('static/admin/images/avatar.jpg') }}" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow">
                <div class="d-flex py-2 px-3">
                    <div class="image d-flex pr-3 align-items-center">
                        <img class="avatar2" src="{{ asset('static/admin/images/avatar.jpg') }}" alt="">
                    </div>
                    <div class="info d-flex flex-column justify-content-center">
                        <p>Dennis</p>
                        <p>dennis@dennis.com</p>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <ul class="navbar-nav ml-0 d-block px-0 second">
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="javascript:void()" data-toggle="modal" data-target="#change">
                            <i class="fas fa-cog text-gray"></i> Cambiar contraseña
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3 pr-1" href="javascript:void()" data-toggle="modal" data-target="#logout">
                            <i class="fas fa-sign-out-alt text-gray"></i> Cerrar sesión
                        </a>
                    </li>
                </ul> 
            </div>
        </li>
    </ul>
</nav>