<?php 
require_once("../../config/conexion.php");
$nombre=trim($_POST['nombre_producto']);
$descripcion=trim($_POST['descripcion_producto']);
$min_stock=trim($_POST['min_stock']);
$precio=trim($_POST['precio']);
$precioEntrada=trim($_POST['precioEntrada']);
$categoria=trim($_POST['categorias_id']);
$stock=$_POST['stock'];
$status=$_POST['status_producto'];
if(!$nombre){
	echo "Ingrese el nombre del producto";
 }else if(!$min_stock){
 	echo "Stock minimo no definido";
 }else if(!$categoria){
 	echo "Categoria vacia";
 }else if(!$descripcion){
 	echo "Ingrese una descripcion";
 }else{
    	session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Agrego un nuevo producto',NOW())";
$result3=$con->query($sql3);
 	$sql2="INSERT INTO productos (nombre_producto,descripcion_producto,stock,status_producto,min_stock,precio,precio_entrada,categorias_id) VALUES ('$nombre','$descripcion','$stock','$status','$min_stock','$precio','$precioEntrada','$categoria')";
 	$result2=$con->query($sql2);
 	echo '<script> swal({
                        title: "¡Producto registrado con exito!",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "inventario.php"; }, delay);</script>';
 }
 ?>