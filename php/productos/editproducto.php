<?php 
require_once("../../config/conexion.php");
$nombre=trim($_POST['nombre_producto']);
$descripcion=trim($_POST['descripcion_producto']);
$categoria=trim($_POST['categorias_id']);
$precioEntrada=trim($_POST['precioEntrada']);
$precio=trim($_POST['precio']);
$min_stock=trim($_POST['min_stock']);
$id=$_POST['id_producto'];

if(!$nombre){
	echo "Ingrese el nombre del producto";
 }else if(!$descripcion){
 	echo "Ingrese una descripcion";
 }else if(!$min_stock){
 	echo "Proveedor vacio";
 }else if(!$precio){
 	echo "Proveedor vacio";
 }else if(!$categoria){
 	echo "categoria vacia";
 }else{
    	session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Update','Modifico un producto',NOW())";
$result3=$con->query($sql3);
 	$sql2="UPDATE productos SET nombre_producto='$nombre',descripcion_producto='$descripcion',precio='$precio',precio_entrada='$precioEntrada',min_stock='$min_stock',categorias_id='$categoria' WHERE id_producto='$id'";
 	$result2=$con->query($sql2);
 	echo '<script> swal({
                        title: "¡Producto editado con exito!",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "inventario.php"; }, delay);</script>';
 }
 ?>