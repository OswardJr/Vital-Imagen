<?php 
require_once("../../config/conexion.php");
$fecha=$_GET['fecha'];

$sql="SELECT p.ced_paciente,p.nombres,p.apellidos,d.nombre,e.nombre_especialidad,c.fecha_cita FROM citas AS c INNER JOIN pacientes AS p ON c.ced_paciente=p.ced_paciente INNER JOIN doctores AS d ON d.id_doctor=c.id_doctor INNER JOIN especialidades AS e ON e.id_especialidad=d.id_especialidad WHERE c.fecha_cita='$fecha'";
$result=$con->query($sql);
while($row=mysqli_fetch_array($result)){
 $fecha=$row['fecha_cita'];
echo '<tr>
			<td>'. $row['ced_paciente'] . '</td>
			<td>'. $row['primer_nombre'] . '</td>
			<td>'. $row['primer_apellido'] . '</td>
			<td>'. $row['nombre_especialidad'] . '</td>
			<td>'. $row['nombre'] . '</td>
			<td>'. str_replace('-', '/', date('d-m-Y',strtotime($fecha))) . '</td>
			<td><a href="" class="btn btn-info"><span class="fa fa-eye"></span></a> <a href="" class="btn btn-warning"><span class="fa fa-pencil-square-o"></span></a> <a href="" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>


	</tr>';




}

 ?>