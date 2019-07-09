<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-desktop"></i> Escritorio
                </a>
            </li>
            <li class="nav-title bg-dropbox">Tienda X</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-university"></i>Inventario</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-database"></i>Categorias</a>
                    </li>
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-users"></i>Productos</a>
                    </li>
                </ul>
            </li>
            <li class="nav-title bg-tumblr">Ventas</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-sign-out"></i>Vender</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa  fa-share"></i>Clientes</a>
                    </li>
                </ul>
            </li>
            <li class="nav-title bg-google-plus">Administracion</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-plus-square"></i>Compras</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-shopping-cart"></i>Ingresos</a>
                    </li>
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-address-book"></i>Proveedores</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-universal-access"></i>Acceso</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=6" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-briefcase"></i>Empleados</a>
                    </li>
                    <li @click="menu=7" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-link"></i>Roles</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-line-chart"></i>Reportes</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-bar-chart"></i>Reporte de Ventas</a>
                    </li>
                    <li @click="menu=9" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-area-chart"></i>Reporte de Usuarios</a>
                    </li>
                </ul>
            </li>
            <li class="nav-title bg-facebook">Miscelanea</li>
            <li @click="menu=19" class="nav-item">
                <a class="nav-link" href="#"><i class="nav-icon fa fa-info-circle"></i>Ayuda <span class="badge badge-light">PDF</span></a>
            </li>
            <li @click="menu=11" class="nav-item">
                <a class="nav-link" href="#"><i class="nav-icon fa fa-question-circle"></i>Acerca de...</a>
            </li>
        </ul>
    </nav>
</div>
