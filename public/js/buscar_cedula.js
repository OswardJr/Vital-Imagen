 $(document).ready(function(){
 
$('#info').hide();
     $('#buscar').click(function(e){
      e.preventDefault();

        var cedula = $("#cedula").val(); 
        var nacionalidad=$('#nacionalidad').val();
         var expcedula=/\d[0-9]/;       
        var dataString = 'cedula='+cedula+'&nacionalidad='+nacionalidad;

        if(cedula===""){
          swal("Ingrese la cedula del paciente a verificar","","error");
          return false;
        }else if(cedula.length<3){
          swal("El campo cedula requiere almenos 3 caracteres","","error");
          return false;
        }else if(cedula.length>12){
          swal("El campo cedula admite maximo 12 caracteres","","error");
          return false;
        }else if(!expcedula.test(cedula)){
          swal("La cedula solo admite numeros","","error");
          return false;
        }else{

        $.ajax({
            type: "POST",
            url: "pacientes/detectarcedula.php",
            data: dataString,
            success: function(data) {
                $('#mensajes').html(data);
                return false;
            }
        });
      }
    });              

    });    