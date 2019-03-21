$(document).ready(function(){
	$('#guardar').click(function(e){
		e.preventDefault();
		

		var cedula=document.getElementById("cedula").value;
		var nombre=document.getElementById("nombre").value;
		var apellido=document.getElementById("apellido").value;
		var sexo=document.getElementById("sexo").value;
		var telefono=document.getElementById("telefono").value;
		var correo=document.getElementById("correo").value;
		var direccion=document.getElementById("direccion").value;

		if(cedula===""){
			swal("Ingresa cedula del doctor","","error");
			return false;
		}else if(nombre===""){
			swal("Ingrese el nombre del doctor","","error");
			return false;
		}else if(apellido===""){
			swal("Ingrese el apellido del doctor","","error");
			return false;
		}else if(sexo===""){
			swal("Seleccione el sexo del doctor","","error");
			return false;
		}else if(telefono===""){
			swal("Ingrese el telefono del doctor","","error");
			return false;
		}else if(!expcorreo.test(correo)){
			swal("Formato del campo correo no valido example@gmail.com","","error");
			return false;
		}else if(direccion===""){
			swal("Ingrese la direccion","","error");
			return false;
		}else{
			$.ajax({
				url:"doctores/adddoctor.php",
				type:"POST",
				data:$('#form_doctor').serialize(),
				success:function(data){
					$('#mensajes').html(data);
				}
			});
		}
	});
});