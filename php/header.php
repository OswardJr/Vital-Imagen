<?php 
session_start();
require_once("../config/conexion.php");
date_default_timezone_set('America/Caracas');
$script_tz = date_default_timezone_get();
if(!isset($_SESSION['id_usuario'])){
    header("location:../index.php");
}
$idUsuario=$_SESSION['id_usuario'];
$sql="SELECT u.id_usuario,u.nombre,u.id_tipo,t.tipo FROM usuarios AS u INNER JOIN tipo_usuario AS t ON u.id_tipo=t.id_tipo WHERE u.id_usuario='$idUsuario'";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$_SESSION['tipo_usuario']=$row['id_tipo'];
$fecha=date("Y".'-'."m"."-"."d");
$citasdehoy=$con->query("SELECT COUNT(*) FROM citas WHERE fecha_cita='$fecha'");
$citaprog=mysqli_fetch_array($citasdehoy);
$alertapro=$con->query("SELECT COUNT(*) FROM productos INNER JOIN categorias ON productos.categorias_id = categorias.id_categoria WHERE stock<min_stock AND status_producto='Activo' AND status_categoria='Activo'");
$alertapr=mysqli_fetch_array($alertapro);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Clínica la paz</title>
    <link rel="shortcut icon" href="../public/multimedia/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/sweetalert2.min.css">
    <link rel="stylesheet" href="../public/c3-0.4.18/c3.min.css">
    <link rel="stylesheet" type="text/css" href="../public/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="../public/loaders.css-master/loaders.min.css">
    <link rel="stylesheet" href="../public/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="../public/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="../public/css/umi.css">
    <link rel="stylesheet" href="../public/css/fuente.css">
    <style>
        .error{
            color: #EB240C;
        }
        #calendar{
        width: px;
        height: ;
       }
    </style>
</head>

<body>
    <div class="loader preloader-lca">
        <div class="loader-inner ball-scale-multiple">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    <div id="wrapper" class="<?php 

        if(isset($_COOKIE['template']) && !empty($_COOKIE['template'])){
            if($_COOKIE['template'] == 1){
                echo ' LgTemplate';
            }
        }
        if(isset($_COOKIE['colorTemplate']) && !empty($_COOKIE['colorTemplate'])){
            if($_COOKIE['colorTemplate'] == 'negro'){
                echo ' tempNegro';
            }else if($_COOKIE['colorTemplate'] == 'azul'){
                echo ' tempAzul';
            }
        }
    ?>">
        <div class="page-wrapper">
            <div class="btn-fab-user">
                <button class="fab bg_gf sub-fab" ><a class="ir-arriba" title="Subir" href="##"><i class="fa fa-arrow-up"></i></a></button>
                <button class="fab bg_txt_gf sub-fab" ><a title="Cerrar sesion" href="../config/logout.php"><i class="fa fa-power-off"></i></a></button>
                <button title="User menu" class="fab bg_txt_aq" id="toggle-fab"><i class="fa fa-bars"></i></button>
            </div>
            <nav>
                <div class="navbar page-navigation" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Men&uacute;</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <span class="navbar-brand"><button class="btn-responsive"><i class="fa fa-caret-left"></i></button></span>
                    </div>

                    <ul class="items-nav navbar-right top-nav">
                        <li>   <strong id="fecha"></strong></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle item-icon" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <b class="caret"></b></a>
                            <ul class="dropdown-menu alert-dropdown">
                               <li class="tittle">
                                    <p><i class="fa fa-exclamation"></i> Notificaciones</p>
                                </li>
                                <?php if($alertapr[0] != 0){ ?>
                                <li>
                                    <a href="inventario.php">Productos por debajo de <br> su stock minimo <span class="label label-warning"><?php echo ($alertapr[0]);?></span></a>
                                </li>
                                <?php }else if($citaprog[0] != 0){ ?>
                                <li>
                                    <a href="citascalendario.php">Citas programadas <span class="label label-danger"><?php echo ($citaprog[0]);?></span></a>
                                </li>
                                <?php }else{
                                        echo '<li class="text-center aviso"><i class="fa fa-exclamation-triangle"></i> No hay notificaciones<li/>';
                                      } ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle item-icon" data-toggle="dropdown"><i class="fa fa-user-o"></i> <b class="caret"></b></a>
                            <ul class="dropdown-menu dropdown-user-menu-top alert-dropdown">
                               <li class="tittle">
                                    <p><i class="fa fa-user"></i> Usuario</p>
                                </li>
                                <li>
                                    <center><span class="username-span" href="#"><?php echo $row['nombre']; ?>: <span class="label 
                                    <?php if($row['tipo'] == 'Administrador'){echo 'label-success';}else{echo 'label-primary';}?>"> <?php echo $row['tipo']; ?></span></span></center>
                                </li>
                                <br>
                                <li class="text-center">
                                    <a href="../config/logout.php">Cerrar Sesion <i class="fa fa-power-off"></i></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>