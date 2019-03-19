<?php 
require_once("../../config/conexion.php");
$id=trim($_POST['id_proveedor']);
$nombre=trim($_POST['nombre_proveedor']);
$rif=trim($_POST['rif']);
$contacto=trim($_POST['nombre_contacto']);
$telefono=trim($_POST['telefono']);
$direccion=trim($_POST['direccion']);

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
 	$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Update','Modifico un proveedor',NOW())";
	$result3=$con->query($sql3);
 	$sql="UPDATE proveedores SET nombre_proveedor='$nombre',rif_proveedor='$rif', contacto_proveedor='$contacto', telefono_proveedor='$telefono', localidad_proveedor='$direccion' WHERE id_proveedor='$id'";
 	$result=$con->query($sql);
 	echo '<script> swal({
                        title: "Proveedor modificado con exito",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });

                var delay = 1000;
                setTimeout(function(){ window.location = "proveedores.php"; }, delay);</script>';
 }
 ?>