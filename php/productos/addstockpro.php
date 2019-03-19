<?php 
require_once("../../config/conexion.php");
$id=$_POST['id_producto'];
$stockactual=$_POST['stockactual'];
$stock=trim($_POST['addstock']);

$newstock=$stockactual+$stock;

 $sql="UPDATE productos SET stock='$newstock' WHERE id_producto='$id'";
 	$result=$con->query($sql);
 	echo '<script> swal({
                        title: "Productos agregados con exito",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "inventario.php"; }, delay);</script>';

 ?>