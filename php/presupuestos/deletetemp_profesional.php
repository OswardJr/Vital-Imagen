<?php 
require("../../config/conexion.php");
$id=$_POST['id'];
$sql2=$con->query("DELETE FROM temp_profesionales WHERE id_doctor='$id'");
$sql=$con->query("SELECT * FROM temp_profesionales INNER JOIN doctores ON temp_profesionales.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad");
	while($row=mysqli_fetch_array($sql)){
		echo '<tr>
					<td>'.$row['nombre_especialidad'].'</td>
					<td>'.$row['nombre'].'</td>
					<td>'.$row['importe'].'</td>
					<td><input type="hidden" value="'.$row['id_doctor'].'" name="id_prof['.$row['id_doctor'].']"><input type="hidden" value="'.$row['importe'].'" name="importe_profesional['.$row['id_doctor'].']"></td>
					<td><a class="btn btn-danger" href="javascript:eliminar_profesional('.$row['id_doctor'].')"><span class="fa fa-trash"></span></a></td>
				</tr>';
	}
 ?>