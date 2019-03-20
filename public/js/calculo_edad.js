$(document).ready(function(){
	$('#fecha_nacimiento').change(function(){
		 var edad=0;
		 var fecha=$('#fecha_nacimiento').val();
		 var hoy=new Date();
		 var diaActual=hoy.getDate();
		 var mesActual=hoy.getMonth() + 1;
		 var yearActual=hoy.getFullYear();

		 if(diaActual<10){
		 	diaActual='0'+ diaActual;
		 }
		 if(mesActual<10){
		 	mesActual= '0' + mesActual;
		 }

		 array_fecha=fecha.split("/");
		 dia=array_fecha[0];
		 mes=array_fecha[1];
		 year=array_fecha[2];


		 if(year >= yearActual){
		 	swal("El año ingresado es mayor o igual que el actual","","error");
		 	$('#fecha_nacimiento').val("");
		 	return false;
		 }else if((mes >= mesActual) && (dia > diaActual)){
		 	edad= (yearActual - 1) - year;
		 }else{
		 	edad=yearActual - year;
		 }
		 $('#edad').val(edad);

	});

	$('#fecha_nacimiento').keypress(function(){
		 var edad=0;
		 var fecha=$('#fecha_nacimiento').val();
		 var hoy=new Date();
		 var diaActual=hoy.getDate();
		 var mesActual=hoy.getMonth() + 1;
		 var yearActual=hoy.getFullYear();

		 if(diaActual<10){
		 	diaActual='0'+ diaActual;
		 }
		 if(mesActual<10){
		 	mesActual= '0' + mesActual;
		 }

		 array_fecha=fecha.split("/");
		 dia=array_fecha[0];
		 mes=array_fecha[1];
		 year=array_fecha[2];


		 if(year >= yearActual){
		 	swal("El año ingresado es mayor o igual que el actual","","error");
		 	$('#fecha_nacimiento').val("");
		 	return false;
		 }else if((mes >= mesActual) && (dia > diaActual)){
		 	edad= (yearActual - 1) - year;
		 }else{
		 	edad=yearActual - year;
		 }
		 $('#edad').val(edad);

	});
});