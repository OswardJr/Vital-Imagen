<?php 
require_once("../../config/conexion.php");
$id=trim($_POST['id_categoria']);
$nombre=trim($_POST['nombre_categoria']);
$descripcion=trim($_POST['descripcion_categoria']);

if(!$nombre){
	echo "Ingrese el nombre de la categoria";
 }else if(!$descripcion){
 	echo "Ingrese una descripcion";
 }else{
    session_start();
    $idUsuario=$_SESSION['id_usuario'];
 	$sql="UPDATE categorias SET nombre_categoria='$nombre',descripcion_categoria='$descripcion' WHERE id_categoria='$id'";
 	$result=$con->query($sql);

 $sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Update','Modifico una categoria',NOW())";
 $result3=$con->query($sql3);


 	echo '<script> swal({
                        title: "Categoria modificada con exito",
                        text: "",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "categorias.php"; }, delay);</script>';
 }
 ?>