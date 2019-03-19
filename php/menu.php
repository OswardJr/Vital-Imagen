<div class="side-nav">
    <div class="side-nav-header">
        <a href="inicio.php"><img src="../public/multimedia/clinica-logo-min.png" height="19" width="22" alt=""><span>Cl&iacute;nica la paz</span></a>
    </div>
    
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="side-menu">
            <li class="">
                <a href="inicio.php"><i class="fa fa-home"></i> <span>Inicio</span></a>
            </li>
            <li class="submenu-content">
            <a href="pacientes.php"><i class="fa fa-heartbeat"></i> <span>Pacientes</span></a>  
            </li>
            <li class="submenu-content">
                <a href="citas.php"><i class="fa fa-calendar"></i> <span>Citas Medicas</span></a>
            </li>
              <li class="submenu-content">
                <a href="citascalendario.php"><i class="fa fa-address-book-o"></i> <span>Consultas Medicas</span></a>
            </li>
            <?php if($_SESSION['tipo_usuario']==1){ ?>
            <li class="submenu-content">
                <a href="##"><i class="fa fa-medkit"></i> <span>Inventario</span><i class="fa fa-fw fa-caret-down"></i></a>
                <ul class="submenu">
                    <li>
                        <a href="inventario.php"><i class="fa fa-stethoscope"></i> <span>Lista de productos</span></a>
                    </li>
                    <li class=""><a href="categorias.php"><i class="fa fa-list-alt"></i> <span>Categorias</span></a>
                    </li>
                    <li>
                        <a href="lotes.php"><i class="fa fa-cubes"></i> <span>Lotes</span></a>
                    </li>
                    <li class=""><a href="proveedores.php"><i class="fa fa-ambulance"></i> <span>Proveedores</span></a>
                    </li>
                </ul>
            </li>
            <?php } ?>

           <li class=""><a href="presupuesto.php"><i class="fa fa-line-chart"></i> <span>Presupuestos</span></a>
            </li>
                
                <li class=""><a href="caja.php"><i class=" fa fa-cart-plus "></i> <span>Caja</span></a>
            </li>
                        <li class=""><a href="configuracion.php"><i class="fa fa-cog"></i> <span>Configuracion</span></a>
             </li>
            </li>
            <?php if($_SESSION['tipo_usuario']==1){ ?>
            <li class="submenu-content">
                <a href="##"><i class="fa fa-cogs"></i> <span>Administración</span><i class="fa fa-fw fa-caret-down"></i></a>
                <ul class="submenu">
                    
                    <li class="">
                    <a href="usuarios.php"><i class="fa fa-users"></i> <span>Usuarios</span></a>
                    </li>
                    <li class=""><a href="doctores.php"><i class="fa fa-user-md"></i> <span>Doctores</span></a>
                    </li>
                      <li class=""><a href="especialidades1.php"><i class="fa fa-sitemap"></i> <span>Areas Medicas</span></a>
                    </li>
                     
                      <li class=""><a href="intervencion.php"><i class="fa fa-universal-access"></i> <span>Tipos de Intervenciones</span></a>
                    </li>
                    <li>
                        <a href="respaldo.php"><i class="fa fa-database"></i> <span>Respaldo</span></a>
                    </li>
                    <li class=""><a href="bitacora.php"><i class="fa fa-history"></i> <span>Bitacora</span></a>
                    </li>

                </ul>
            </li>

            <?php } ?>
        </ul>
    </div>
</div>
</div>

