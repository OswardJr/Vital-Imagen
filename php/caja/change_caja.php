<?php 
require_once("../../config/conexion.php");
	$cliente=$_POST['cliente'];
	$tabla='';

	$total=0.00;
	$subtotal=0.00;

	$tabla .= ' <table class="table table-bordered" style="margin-bottom: 20px;">
                    <thead>
                        <th>Doctor</th>
                        <th>Especialidad</th>
                        <th>Pago</th>
                    </thead>
                    <tbody id="content">';

	$sql=$con->query("SELECT * FROM consultas INNER JOIN pacientes ON consultas.ced_paciente=pacientes.ced_paciente INNER JOIN doctores ON consultas.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad WHERE pacientes.ced_paciente='$cliente' and consultas.status_pago='pendiente'");
	while($row=mysqli_fetch_array($sql)){
		$pago_consulta=$row['pago_consulta'];
		$subtotal += $pago_consulta;
			$tabla .= '<tr>
							<td>'.$row['nombre'].'</td>
							<td>'.$row['nombre_especialidad'].'</td>
							<td>'.$row['pago_consulta'].'<input type="hidden" name="id_consulta['.$row['id_consulta'].']" value="'.$row['id_consulta'].'"></td>
						</tr>';
	}
	$iva=$subtotal*0.12;
	$total=$subtotal+$iva;
			$tabla .= '</tbody>
					</table>
			
					<div class="alert alert-info col-md-4 col-md-offset-8">
					<h4 class="">SubTotal:</h4><br>
					<input class="form-control" type="text" readonly value="'.$subtotal.'"><br>
					<h4 class="">+ 12% Iva:</h4><br>
					<input class="form-control" type="text" readonly value="'.$iva.'"><br>
					<h4 class="">Total:</h4><br>
					<input type="hidden" name="total" value="'.$total.'">
					<input type="hidden" name="ced_paciente" value="'.$cliente.'">
					<input class="form-control" type="text" readonly value="'.$total.'">
					</div>';

		
	echo $tabla;
 ?>