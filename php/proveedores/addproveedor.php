<?php 
require_once("../../config/conexion.php");
$nombre=trim($_POST['nombre_proveedor']);
$rif=trim($_POST['rif']);
$contacto=trim($_POST['nombre_contacto']);
$telefono=trim($_POST['telefono']);
$direccion=trim($_POST['direccion']);
$status=trim($_POST['status_proveedor']);

if(!$nombre){
	echo "Ingrese el nombre del proveedor";
 }if(!$rif){
	echo "Ingrese el nombre del proveedor";
 }if(!$contacto){
	echo "Ingrese el nombre del proveedor";
 }if(!$telefono){
	echo "Ingrese el nombre del proveedor";
 }if(!$direccion){
	echo "Ingrese el nombre del proveedor";
 }else{
    session_start();
    $idUsuario=$_SESSION['id_usuario'];
 	$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Insertar','Inserto un proveedor',NOW())";
	$result3=$con->query($sql3);
 	$sql2="INSERT INTO proveedores(nombre_proveedor,rif_proveedor,contacto_proveedor,telefono_proveedor,localidad_proveedor,status_proveedor) VALUES ('$nombre','$rif','$contacto','$telefono','$direccion','$status')";
 	$result2=$con->query($sql2);
 	echo '<script> swal({
                        title: "Proveedor guardado con exito",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "proveedores.php"; }, delay);</script>';
 }
 ?>