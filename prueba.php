<?php 
require_once("config/conexion.php");
$sql="SELECT * FROM pacientes";
$result=$con->query($sql);

?>


<table>
	<thead>
		<th>Selecciona</th>
		<th>Nombre</th>
		<th>Apllido</th>
	</thead>
	<tbody>
		<?php while($row=mysqli_fetch_array($result)){ ?>
		<tr>
				<td><input type="checkbox" name="paciente[]" id="paciente" onchange="verpaciente()"></td>
				<td><?php echo $row['nombres']; ?></td>
				<td><?php echo $row['apellidos']; ?> <input type="text" name="" id="ver" style="display: none;"></td>
		</tr>
		<?php } ?>
	</tbody>

</table>

<script type="text/javascript">
	function verpaciente(){
		var paciente=document.getElementById('paciente');
			var ver=document.getElementById('ver');
		if(paciente.checked){
			ver.css('display','block');
		}else{
			alert("no");
		}
	}
</script>