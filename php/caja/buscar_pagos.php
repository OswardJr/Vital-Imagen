<?php 
require_once("../../config/conexion.php");
$desde=$_GET['desde'];
$hasta=$_GET['hasta'];

$pagos=$con->query("SELECT * FROM pagos INNER JOIN pacientes ON pagos.ced_paciente=pacientes.ced_paciente INNER JOIN usuarios ON pagos.id_usuario=usuarios.id_usuario WHERE pagos.fecha BETWEEN '$desde' AND '$hasta'");
while($row=mysqli_fetch_array($pagos)){
echo '<tr>
			<td>'. $row['usuario'] . '</td>
			<td>'. $row['nombres'] . '</td>
			<td>'. $row['fecha'] . '</td>
			<td>'. $row['hora'] . '</td>
			<td>'. $row['total_cancelar'] . '</td>
			<td><a href="#" onclick="verpago('.$row['nro_pago'].'.','.'.$row['usuario'].'.','.'.$row['nombres'].'.','.'.$row['fecha'].'.','.'.$row['hora'].'.','.'.$row['total_cancelar'].');" data-target="#verpago" data-toggle="modal" class="btn btn-info" style=""><span class="fa fa-eye" style=""></span></a> <a href="javascript:eliminar_pago('.$row['nro_pago'].');" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
	</tr>';




}

 ?>