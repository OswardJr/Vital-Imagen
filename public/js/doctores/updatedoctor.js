$(document).ready(function(){
	$('#guardar').click(function(e){
		e.preventDefault();
		
		var cedula,nombre,apellido,sexo,telefono,correo,direccion,especialidad,expcedula,expnombre,expapellido,exptelefono,expcorreo,expdireccion;

		cedula=document.getElementById("cedula").value;
		expcedula=/[a-zA-Z]{1}-\d[0-9]/;
		nombre=document.getElementById("nombre").value;
		expnombre=/[a-zA-Za]/;
		apellido=document.getElementById("apellido").value;
		expapellido=/[a-zA-Z]/;
		sexo=document.getElementById("sexo").value;
		telefono=document.getElementById("telefono").value;
		exptelefono=/\d{4}-\d[0-7]/;
		correo=document.getElementById("correo").value;
		expcorreo=/\w+@\w+\.+[a-z]/;
		direccion=document.getElementById("direccion").value;
		expdireccion=/[a-zA-Z#]/;
		especialidad=document.getElementById("especialidad").value;

		if(cedula===""){
			swal("Ingresa cedula del doctor","","error");
			return false;
		}else if(cedula.length<3){
			swal("El campo cedula requiere almenos 3 caracteres","","error");
			return false;
		}else if(cedula.length>12){
			swal("El campo cedula admite como maximo 12 caracteres","","error");
			return false;
		}else if(!expcedula.test(cedula)){
			swal("Formato de cedula invalido v-24924739","","error");
			return false;
		}else if(nombre===""){
			swal("Ingrese el nombre del doctor","","error");
			return false;
		}else if(nombre.length<3){
			swal("El campo nombre requiere almenos 3 caracteres","","error");
			return false;
		}else if(nombre.length>20){
			swal("El campo nombre admite como maximo 20 caracteres","","error");
			return false;
		}else if(!expnombre.test(nombre)){
			swal("El campo nombre solo admite letras","","error");
			return false;
		}else if(apellido===""){
			swal("Ingrese el apellido del doctor","","error");
			return false;
		}else if(apellido.length<3){
			swal("El campo apellido requiere almenos 3 caracteres","","error");
			return false;
		}else if(apellido.length>20){
			swal("El campo apellido admite como maximo 20 caracteres","","error");
			return false;
		}else if(!expapellido.test(apellido)){
			swal("El campo apellido solo admite letras","","error");
			return false;
		}else if(sexo===""){
			swal("Seleccione el sexo del doctor","","error");
			return false;
		}else if(telefono===""){
			swal("Ingrese el telefono del doctor","","error");
			return false;
		}else if(!exptelefono.test(telefono)){
			swal("Formato del campo telefono no valido 0416-2415105","","error");
			return false;
		}else if(telefono.length>15){
			swal("El campo telefono admite maximo 15 caracteres","","error");
			return false;
		}else if(correo===""){
			swal("Ingrese el correo electronico","","error");
			return false;
		}else if(!expcorreo.test(correo)){
			swal("Formato del campo correo no valido example@gmail.com","","error");
			return false;
		}else if(correo.length>30){
			swal("El campo correo admite maximo 15 caracteres","","error");
			return false;
		}else if(direccion===""){
			swal("Ingrese la direccion","","error");
			return false;
		}else if(!expdireccion.test(direccion)){
			swal("El campo direccion solo admite numeros,letras  y #","","error");
			return false;
		}else if(direccion.length>30){
			swal("El campo direccion admite maximo 30 caracteres","","error");
			return false;
		}else if(especialidad===""){
			swal("Seleccione la especialidad del doctor","","error");
			return false;
		}else{
			$.ajax({
				url:"doctores/editdoctor.php",
				type:"POST",
				data:$('#form_doctor').serialize(),
				success:function(data){
					$('#mensajes').html(data);
				}
			});
		}
	});
});