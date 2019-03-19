<?php 
require_once("../../config/conexion.php");
$id=$_POST['id_producto'];
$stockactual=$_POST['stockactual'];
$stock=trim($_POST['addstock']);

$newstock=$stockactual-$stock;
if($newstock > 0){
	$sql="UPDATE productos SET stock='$newstock' WHERE id_producto='$id'";
 	$result=$con->query($sql);
 	echo '<script> swal({
                        title: "Productos descontados con exito",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "inventario.php"; }, delay);</script>';
}else{
 	echo '<script> swal({
                        title: "Error",
                        text: "No se pueden descontar mas de los productos en existencia",
                        type: "error",
                    });
          </script>';
 }
 ?>