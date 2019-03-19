<?php 
require_once("../../config/conexion.php");
$id_doctor=$_POST['id_profesional'];
$imprimir='';
$importe=$_POST['importe_profesional'];
$buscar=$con->query("SELECT * FROM temp_profesionales WHERE id_doctor='$id_doctor'");
$insert=$con->query("INSERT INTO temp_profesionales(id_doctor,importe) VALUES('$id_doctor','$importe')");
$select=$con->query("SELECT * FROM temp_profesionales INNER JOIN doctores ON temp_profesionales.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad");

while($row=mysqli_fetch_array($select)){
		echo '<tr>
					<td>'.$row['nombre_especialidad'].'</td>
					<td>'.$row['nombre'].'</td>
					<td>'.$row['importe'].'</td>
					<td><input type="hidden" value="'.$row['id_doctor'].'" name="id_prof['.$row['id_doctor'].']"><input type="hidden" value="'.$row['importe'].'" name="importe_profesional['.$row['id_doctor'].']"></td>
					<td><a href="javascript:eliminar_profesional('.$row['id_doctor'].')" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
				</tr>';	
	}


 ?>

