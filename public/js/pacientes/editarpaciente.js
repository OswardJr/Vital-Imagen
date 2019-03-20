$(document).ready(function(){
	$('#guardar').click(function(e){
		e.preventDefault();
	var nombres=document.getElementById("nombres").value;
	var apellidos=document.getElementById("apellidos").value;
	var sexo=document.getElementById("sexo").value;
	var fecha_nacimiento=document.getElementById("fecha_nacimiento").value;
	var telefono_movil=document.getElementById("telefono_movil").value;
	var telefono_local=document.getElementById("telefono_local").value;
	var estado=document.getElementById("estado").value;
	var ciudad=document.getElementById("ciudad").value;
	var municipio=document.getElementById("municipio").value;
	var parroquia=document.getElementById("parroquia").value;
	var direccion=document.getElementById("direccion").value;
	
	if(nombres===""){
		swal("El nombre es requerido","","error");
		return false;
	}else if(apellidos===""){
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
			url:"pacientes/update.php",
			type:"POST",
			data:$('#form_paciente').serialize(),
			success:function(data){
				$('#mensajes').html(data);
			}
		});
	}


});
});