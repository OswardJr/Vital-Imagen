<?php 
require_once("../../config/conexion.php");
$nombre=trim(strtoupper($_POST['nombre']));
$descripcion=trim(strtoupper($_POST['descripcion']));


$search=mysqli_query($con,"SELECT * FROM servicios WHERE nombre_servicio='$nombre'");
$s=mysqli_num_rows($search);
if($s == 0){
 	$sql2="INSERT INTO servicios(nombre_servicio,descripcion) VALUES ('$nombre','$descripcion')";
 	$result2=$con->query($sql2);

 	session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Agrego un nuevo servicio',NOW())";
$result3=$con->query($sql3);

if($sql2){
 	echo '<script> swal({
                        title: "Servicio guardado con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "servicios.php"; }, delay);</script>';
  }
 }else{
 	echo '<script>
		swal("La nombre ingresado ya se encuentra registrado, intenta nuevamente","","success");
 	</script>';
 }
 
 ?>
