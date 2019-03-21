$(document).ready(function(){
	$('#guardar').click(function(e){
		e.preventDefault();
		

		var nombre=document.getElementById("nombre").value;
		var descripcion=document.getElementById("descripcion").value;
		

		if(nombre === ""){
			swal("El campo nombre es requerido","","error");
			return false;
		}else{
			$.ajax({
				url:"servicios/updateservicio.php",
				type:"POST",
				data:$('#form_doctor').serialize(),
				success:function(data){
					$('#mensajes').html(data);
				}
			});
		}
	});
});