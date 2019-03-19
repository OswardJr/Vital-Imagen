$(document).ready(function(){

        $('#estado').on('change',function(){
            var estado=$('#estado').val();
            $.ajax({
                url:"pacientes/estado_ciudad.php",
                type:"POST",
                data:{'estado': estado},
                success:function(respuesta){
                    $('#ciudad').html(respuesta);
                }
            });
        });

          $('#estado').on('change',function(){
            var estado=$('#estado').val();
            $.ajax({
                url:"pacientes/estado_municipio.php",
                type:"POST",
                data:{'estado': estado},
                success:function(respuesta){
                    $('#municipio').html(respuesta);
                }
            });
        });


          $('#municipio').on('change',function(){
            var municipio=$('#municipio').val();
            $.ajax({
                url:"pacientes/municipio_parroquia.php",
                type:"POST",
                data:{'municipio': municipio},
                success:function(respuesta){
                    $('#parroquia').html(respuesta);
                }
            });
        });

    });

