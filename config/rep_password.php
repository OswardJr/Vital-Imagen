<?php
require("../config/conexion.php");
$usuario=$_GET['usuario'];
$pre_seguridad=$_GET['pre_seguridad'];
$res_seguridad=$_GET['res_seguridad'];
$sql="SELECT * FROM usuarios WHERE usuario='$usuario' AND pre_seguridad='$pre_seguridad' AND res_seguridad='$res_seguridad'";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$rows=$result->num_rows;
if($rows){
		echo '<script> swal({
                        title: "Usuario Correcto",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "nuevo_password.php?usuario='.$row['usuario'].'"; }, delay);</script>';
}else{
	echo "Datos erroneos intente de nuevo";
}