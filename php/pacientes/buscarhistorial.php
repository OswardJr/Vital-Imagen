<?php 
require("../../config/conexion.php");
$cedula=trim($_GET['cedula']);

$sql=$con->query("SELECT * FROM pacientes WHERE ced_paciente='$cedula'");
$sql2="SELECT cn.id_consulta,cn.diagnostico,c.id_citas,c.fecha_cita FROM consultas AS cn INNER JOIN citas AS c ON cn.id_cita=c.id_citas INNER JOIN pacientes AS p ON c.ced_paciente=p.ced_paciente WHERE p.ced_paciente='$cedula'";
$rr=$con->query($sql2);
$diagnosticos=$rr->num_rows;
$paciente=mysqli_fetch_assoc($sql);
if($sql->num_rows>0){
                   
echo ' <div id="mensajess"></div><div class="panel" id="">
                        <div class="panel-heading"><center><h3><i>Historial</i></h3></center></div>
                        <div id="content" class="panel-body">
            <form action="" id="form_historial">
			<center class="text_center"><h3><strong><i>Datos Personales</i></strong></h5></center></br>
		<div class="form-group col-xs-4">
			<label for="cedula">Cedula del Paciente:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['ced_paciente'].'" name="cedula">
		</div>


		<div class="form-group col-xs-4">
			<label for="cedula">Nombres:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['nombres'].'" name="nombres">
		</div>

		<div class="form-group col-xs-4">
			<label for="cedula">Apellidos:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['apellidos'].'" name="apellidos">
		</div>

		<div class="form-group col-xs-4">

			<label for="cedula">Sexo:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['sexo'].'" name="sexo">

		</div>

		<div class="form-group col-xs-4">

			<label for="cedula">Fecha de Nacimiento:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['fecha_nacimiento'].'" name="fecha_nacimiento">

		</div>

			<div class="form-group col-xs-4">

			<label for="cedula">Edad:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['edad'].'" name="edad">

		</div>

		<div class="form-group col-xs-4">

			<label for="cedula">Responsable del Paciente:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['responsable'].'" name="responsable">

		</div>

		<div class="form-group col-xs-4">

			<label for="cedula">Direccion:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['direccion'].'" name="direccion">

		</div>

		<div class="form-group col-xs-4">

			<label for="cedula">Telefono:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['telefono'].'" name="telefono">

		</div>

		<div class="form-group col-xs-6">

			<label for="cedula">Enfermedad:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['enfermedad'].'" name="enfermedad">

		</div>';  if($paciente['enfermedad']=='Si'){

		echo '<div class="form-group col-xs-6">

			<label for="cedula">Descripcion de la Enfermedad:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['d_enfermedad'].'" name="d_enfermedad">

		</div>';
	}else{
			echo '<div class="form-group col-xs-6">

			<label for="cedula">Descripcion de la Enfermedad:</label>
			<input type="text" class="form-control" disabled value="No aplica">

		</div>';
	}
	echo '
		<div class="form-group col-xs-6">

			<label for="cedula">Alergia:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['alergia'].'" name="alergia">

		</div>';


	if($paciente['alergia']=='Si'){

		echo '<div class="form-group col-xs-6">

			<label for="cedula">Descripcion de la Alergia:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['d_alergia'].'" name="d_alergia">

		</div>';
	}else{

		echo '<div class="form-group col-xs-6">

			<label for="cedula">Descripcion de la Alergia:</label>
			<input type="text" class="form-control" disabled value="No Aplica">

		</div>';


	}


	echo '<div class="form-group col-xs-6">

			<label for="cedula">Antecedentes de Enfermedad:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['a_enfermedad'].'" name="a_enfermedad">

		</div>';

	if($paciente['a_enfermedad']=='Si'){

		echo '<div class="form-group col-xs-6">

			<label for="cedula">Descripcion de la Enfermedad:</label>
			<input type="text" class="form-control" disabled value="'.$paciente['d_antecedente'].'" name="d_antecedente">

		</div>';
	}else{

		echo '<div class="form-group col-xs-6">

			<label for="cedula">Descripcion de la Enfermedad:</label>
			<input type="text" class="form-control" disabled value="No Aplica">

		</div><br><br>';

	}
	if($diagnosticos>0){

		echo '<div class="text-center"><h3>Diagnostico:</h3></div>';
	while($row=mysqli_fetch_array($rr)){
		
			
			echo '<div class="row"><div class="form-group col-xs-6">
		<label>Diagnostico:</label>
		<textarea class="form-control" name="diagnostico['.$row['id_consulta'].']">'.$row['diagnostico'].'</textarea>
		
		</div>

		<div class="form-group col-xs-6">
		<label>Fecha:</label>
		<input class="form-control" disbleD value="'.$row['fecha_cita'].'">
		</div>
		</div>

		<input type="hidden" name="idconsulta['.$row['id_consulta'].']" value="'.$row['id_consulta'].'">';

		}
		}

	

	echo '<div class="text-center col-xs-12">

             <button type="submit" id="guardar_historial" name="guardar_historial" class="btn btn-lca" style="" title="Guardar Historial">
              <i class="fa fa-check-square-o"></i></button>
              <a href="../../reportes/historial.php?cedula='.$cedula.'"  class="btn btn-lca" target="_blank">
              <i class="fa fa-print" title="Imprimir Historial"></i></a>

              <input type="hidden" name="ced_paciente" value="'.$cedula.'">
              <a id="volver" href="historiapaciente.php" class="btn btn-lca" title="Volver"><i class="fa fa-undo"></i></a>
                       

		</div>

		</form></div>
                    </div>

          <script>
          $(document).ready(function(){

          	$("#guardar_historial").click(function(e){
          		e.preventDefault();
          		$.ajax({
          			url:"pacientes/guardar_historial.php",
          			type:"POST",
          			data:$("#form_historial").serialize(),
          			success:function(data){
          				$("#mensajess").html(data);
          			}
          		});
          	});

          	
          
          });
          </script>';
   }

 ?>