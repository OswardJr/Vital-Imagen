$(document).ready(function(){
	$('#guardar').click(function(e){
		e.preventDefault();
	var nacionalidad,cedula,nombre,apellido,sexo,fecha_nacimiento,telefono,estado,ciudad,municipio,parroquia,direccion,responsable,expcedula,expnombre,expapellido,expfecha,exptelefono,expdireccion;
	nacionalidad=document.getElementById("nacionalidad").value;
	cedula=document.getElementById("cedula").value;
	expcedula=/\d[0-9]/;
	nombre=document.getElementById("nombres").value;
	expnombre=/[a-zA-Z]/;
	apellido=document.getElementById("apellidos").value;
	expapellido=/[a-zA-Z]/;
	sexo=document.getElementById("sexo").value;
	fecha_nacimiento=document.getElementById("fecha_nacimiento").value;
	expfecha=/\d{2}\/\d{2}\/\d{4}/;
	telefono=document.getElementById("telefono").value;
	exptelefono=/\d[0-9]/;
	estado=document.getElementById("estado").value;
	ciudad=document.getElementById("ciudad").value;
	municipio=document.getElementById("municipio").value;
	parroquia=document.getElementById("parroquia").value;
	direccion=document.getElementById("direccion").value;
	expdireccion=/[a-zA-Z0-9]/;
	responsable=document.getElementById("responsable").value;
	
	if(nacionalidad===""){
		swal("Ingrese la Nacionalidad del paciente","","error");
		return false;
	}else if(cedula ===""){
		swal("Ingrese la cedula","","error");
		return false;

	}else if(cedula.length<3){
		swal("El campo cedula requiere almenos 3 caracteres","","error");
		return false;
	}else if(cedula.length>12){
		swal("El campo cedula admite maximo 20 caracteres","","error");
		return false;
	}else if(!expcedula.test(cedula)){
		swal("La Cedula solo admite numeros","","error");
		return false;
	}else if(nombre===""){
		swal("Ingrese el nombre","","error");
		return false;
	}else if(!expnombre.test(nombre)){
		swal("El campo nombre solo admite letras","","error");
		return false;
	}else if(nombre.length<3){
		swal("El campo nombre requiere minimo 3 caracteres","","error");
		return false;
	}else if(nombre.length>20){
		swal("El campo nombre admite maximo 20 caracteres","","error");
		return false;
	}else if(apellido===""){
		swal("Ingrese el apellido","","error");
		return false;
	}else if(!expapellido.test(apellido)){
		swal("El campo apellido solo admite letras","","error");
		return false;
	}else if(apellido.length<3){
		swal("El campo apellido requiere minimo 3 caracteres","","error");
		return false;
	}else if(apellido.length>20){
		swal("El campo apellido admite maximo 20 caracteres","","error");
		return false;
	}else if(sexo===""){
		swal("Seleccione el sexo","","error");
		return false;
	}else if(fecha_nacimiento===""){
		swal("Ingrese la fecha de nacimiento","","error");
		return false;
	}else if(!expfecha.test(fecha_nacimiento)){
		swal("Formato del campo fecha no valido dd/mm/yyyy","","error");
		return false;
	}else if(telefono===""){
		swal("Ingrese el telefono","","error");
		return false;
	}else if(!exptelefono.test(telefono)){
		swal("El campo telefono solo admite numeros","","error");
		return false;
	}else if(telefono.length>15){
		swal("El campo telefono admite maximo 15 caracteres","","error");
		return false;
	}else if(estado===""){
		swal("Seleccione el estado","","error");
		return false;
	}else if(ciudad===""){
		swal("Seleccione la ciudad","","error");
		return false;
	}else if(municipio===""){
		swal("Seleccione el municipio","","error");
		return false;
	}else if(parroquia===""){
		swal("Seleccione la parroquia","","error");
		return false;
	}else if(direccion===""){
		swal("Ingrese la direccion","","error");
		return false;
	}else if(!expdireccion.test(direccion)){
		swal("El campo direccion solo admite numeros,letras y #","","error");
		return false;
	}else if(direccion.length<3){
		swal("El campo direccion requiere minimo 3 caracteres","","error");
		return false;
	}else if(direccion.length>50){
		swal("El campo direccion admite maximo 50 caracteres","","error");
		return false;
	}else if(responsable===""){
		swal("Ingrese el responsable","","error");
		return false;
	}else if(!expnombre.test(responsable)){
		swal("El campo responsable solo admite letras","","error");
		return false;
	}else if(responsable.length<3){
		swal("El campo responsable requiere minimo 3 caracteres","","error");
		return false;
	}else if(responsable.length>20){
		swal("El campo responsable admite maximo 20 caracteres","","error");
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