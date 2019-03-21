<?php 
session_start();
require_once("../config/conexion.php");
date_default_timezone_set('America/Caracas');
$script_tz = date_default_timezone_get();
if(!isset($_SESSION['id_usuario'])){
    header("location:../index.php");
}
$idUsuario=$_SESSION['id_usuario'];
$result=mysqli_query($con,"SELECT * FROM usuarios WHERE id_usuario='$idUsuario'");
$row=mysqli_fetch_assoc($result);
$fecha=date("Y".'-'."m"."-"."d");
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Centro Profesional Cardonal Smile</title>
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/c3-0.4.18/c3.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/loaders.css-master/loaders.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/umi.css">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>public/css/fuente.css">

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
    <div id="wrapper" class="tempAzul">
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
                    </div>

                    <ul class="items-nav navbar-right top-nav">
                        <li>   <strong id="fecha"></strong></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle item-icon" data-toggle="dropdown"><i class="fa fa-user-o"></i> <b class="caret"></b></a>
                            <ul class="dropdown-menu dropdown-user-menu-top alert-dropdown">
                               <li class="tittle">
                                    <p><i class="fa fa-user"></i> Usuario</p>
                                </li>
                                <li>
                                    <center><span class="username-span" href="#"><?php echo $row['nombre']; ?> <span class="label-success"></span></span></center>
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