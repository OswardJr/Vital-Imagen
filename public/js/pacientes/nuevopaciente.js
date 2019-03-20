$(document).ready(function(){
	$('#guardar').click(function(e){
		e.preventDefault();
	var nacionalidad=document.getElementById("nacionalidad").value;
	var cedula=document.getElementById("cedula").value;
	var nombre=document.getElementById("nombres").value;
	var apellido=document.getElementById("apellidos").value;
	var sexo=document.getElementById("sexo").value;
	var fecha_nacimiento=document.getElementById("fecha_nacimiento").value;
	var telefono_local=document.getElementById("telefono_local").value;
	var telefono_movil=document.getElementById("telefono_movil").value;
	var estado=document.getElementById("estado").value;
	var ciudad=document.getElementById("ciudad").value;
	var municipio=document.getElementById("municipio").value;
	var parroquia=document.getElementById("parroquia").value;
	var direccion=document.getElementById("direccion").value;
	
	if(nacionalidad===""){
		swal("La nacionalidad es requerida","","error");
		return false;
	}else if(cedula ===""){
		swal("La cedula es requerida","","error");
		return false;

	}else if(nombre===""){
		swal("El nombre es requerido","","error");
		return false;
	}else if(apellido===""){
		swal("El apellido es requerido","","error");
		return false;
	}else if(sexo===""){
		swal("El campo sexo es requerido","","error");
		return false;
	}else if(fecha_nacimiento===""){
		swal("La fecha de nacimiento es requerida","","error");
		return false;
	}else if(telefono_movil === ""){
		swal("El teléfono movil es requerido","","error");
		return false;
	}else if(estado===""){
		swal("El campo estado es requerido","","error");
		return false;
	}else if(ciudad===""){
		swal("El campo ciudad es requerido","","error");
		return false;
	}else if(municipio===""){
		swal("El campo municipio es requerido","","error");
		return false;
	}else if(parroquia===""){
		swal("El campo parroquia es requerido","","error");
		return false;
	}else if(direccion===""){
		swal("La dirección es requerida","","error");
		return false;
	}else{
		$.ajax({
			url:"pacientes/addpaciente.php",
			type:"POST",
			data:$('#form_paciente').serialize(),
			success:function(data){
				$('#mensajes').html(data);
			}
		});
	}


});
});