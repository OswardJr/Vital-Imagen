$(document).ready(function(){
	$('#guardar').click(function(e){
		e.preventDefault();
		
		var cedula,nombre,apellido,sexo,telefono,correo,direccion,especialidad,expcedula,expnombre,expapellido,exptelefono,expcorreo,expdireccion;

		cedula=document.getElementById("cedula").value;
		expcedula=/\d[0-9]/;
		nombre=document.getElementById("nombre").value;
		expnombre=/[a-zA-Za]/;
		apellido=document.getElementById("apellido").value;
		expapellido=/[a-zA-Z]/;
		sexo=document.getElementById("sexo").value;
		telefono=document.getElementById("telefono").value;
		correo=document.getElementById("correo").value;
		expcorreo=/\w+@\w+\.+[a-z]/;
		direccion=document.getElementById("direccion").value;

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