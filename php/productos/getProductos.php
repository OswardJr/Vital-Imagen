<?php
require_once("../../config/conexion.php"); 
$sql=$con->query("SELECT * FROM categorias  WHERE  status_categoria='Activo' ");

while($resultado = mysqli_fetch_array($sql))
{
	$nombreCat = $resultado['id_categoria'];

	$seleccionarCategoria = $con->query("SELECT COUNT(*) FROM 
		productos WHERE categorias_id='$nombreCat' ");
	$productosContados = mysqli_fetch_array($seleccionarCategoria);

	$data[] = [
		$resultado['nombre_categoria'] ,
		$productosContados[0]
	];
}

 echo json_encode($data);
 ?>