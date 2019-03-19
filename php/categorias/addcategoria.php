<?php 
require_once("../../config/conexion.php");
$nombre=trim($_POST['nombre_categoria']);
$descripcion=trim($_POST['descripcion_categoria']);
$status=trim($_POST['status_categoria']);

if(!$nombre){
	echo "Ingrese el nombre de la categoria";
 }else if(!$descripcion){
 	echo "Ingrese una descripcion";
 }else{
        session_start();
    $idUsuario=$_SESSION['id_usuario'];
 	$sql2="INSERT INTO categorias(nombre_categoria,descripcion_categoria,status_categoria) VALUES ('$nombre','$descripcion','$status')";
 	$result2=$con->query($sql2);

 	$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Inserto una categoria',NOW())";
	$result3=$con->query($sql3);


 	echo '<script> swal({
                        title: "Categoria guardada con exito",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "categorias.php"; }, delay);</script>';
 }
 ?>