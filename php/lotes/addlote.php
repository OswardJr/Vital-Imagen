<?php
require_once("../../config/conexion.php");
if(isset($_POST['codigo_lote'])){

$idelotesc=$con->query("SELECT COUNT(*) FROM lotes");
$id_deta=mysqli_fetch_array($idelotesc);
$id_detalle=$id_deta[0]+1;
/*DATOS DEL LOTE*/
$codigo=$_POST['codigo_lote'];
$proveedores=$_POST['proveedores_id'];
$fechaEnt=$_POST['fecha_ent'];
$numpro=$_POST['numero_productos'];

/*INGRESO DE PRODUCTOS*/

$datoslt=$con->query("INSERT INTO lotes (codigo_lote,productos_lote) VALUES ('$codigo','$numpro')");
    
foreach ($_POST['idpro'] as $ids) {
	$idpro=mysqli_real_escape_string($con,$_POST['idpro'][$ids]);
	$stock=mysqli_real_escape_string($con,$_POST['stockpro'][$ids]);
	$addstock=mysqli_real_escape_string($con,$_POST['addstock'][$ids]);
    $fechaVenc=mysqli_real_escape_string($con,$_POST['fecha_venc'][$ids]);

	$lotestock=$stock+$addstock;

	$ingresolote=$con->query("INSERT INTO inventario (proovedores_id,lotes_id,productos_id,fechaEnt,fechaVenc,cantidad,status_inventario) VALUES ('$proveedores','$id_detalle','$idpro','$fechaEnt','$fechaVenc','$addstock','Pendiente') ");
}

if($ingresolote==true){
			  echo '<script> swal({
                        title: "¡Lote ingresado con exito!",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "lotes.php"; }, delay);</script>';		
}else{
	echo "ERROR PAPA";
}
    
    
}else{
	header('location:../lotes.php');
}
?>