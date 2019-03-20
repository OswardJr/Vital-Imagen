<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <span class="breadcoumb"><a href="usuarios.php">Usuarios</a> <i class="fa fa-caret-right"> </i> Nuevo usuario</span>
        </div>
    </div>
        <div class="row" style="">
            <div class="col-xs-12 col-xs-offset-">

                <h5 id="mensajes"></h5>
   
        <div class="panel panel-default">
            <div class="panel-heading" style="">
                <center>
                    <h3 style=""><i class="fa fa-plus"></i> Nuevo Usuario</h3>
                </center>
            </div>

            <div class="panel-body">

                <form action="" id="form_usuario" class="form-lca">
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="nombre">Nombre: <span style="color: red;">*</span></label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese su nombre">
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="apellido">Apellido: <span style="color: red;">*</span></label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese su apellido">
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="sexo">Sexo: <span style="color: red;">*</span></label>
                        <select name="sexo" id="sexo" class="form-control">
                                  <option value="Masculino">Masculino</option>
                                  <option value="Femenino">Femenino</option>
                                  <option value="Indefinido">Indefinido</option>
                              </select>
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="usuario">Nombre de usuario: <span style="color: red;">*</span></label>
                        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Nombre de usuario">
                    </div>
            
                    <div class="form-group  col-md-6 col-sm-12">
                        <label for="">Contraseña: <span style="color: red;">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="confirm_password">Confirmar contraseña: <span style="color: red;">*</span></label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="correo_electronico">Correo Electronico <span style="color: red;">*</span></label>
                        <input type="text" name="correo" id="correo" class="form-control" placeholder="example@gmail.com">
                    </div>
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="pregunta">Pregunta secreta <span style="color: red;">*</span></label>
                        <select name="pregunta" id="pregunta" class="form-control">
                                 <option value="">Seleccione una pregunta</option>
                                 <option value="Nombre de tu mascota?">Nombre de tu mascota?</option>
                                 <option value="Color favorito?">Color favorito?</option>
                                 <option value="Nombre de tu mejor amigo de la infancia?">Nombre de tu mejor amigo de la infancia?</option>  
                                 <option value="Nombre de tu abuela materna?">Nombre de tu abuela materna?</option>
                                 <option value="Equipo de futbl favorito?">Equipo de futbol favorito?</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6 col-sm-12">
                        <label for="respuesta">Respuesta secreta <span style="color: red;">*</span></label>
                        <input type="text" name="respuesta" id="respuesta" class="form-control" placeholder="Ingrese su respuesta">
                    </div>
               
                    <div class="botones-formulario text-center">
                          <button type="submit" title="Guardar usuario" id="guardar_usuario" name="guardar_usuario" class="btn btn-lca">
                            <i class="fa fa-save"></i>
                        </button>
                        <a href="usuarios.php" title="Regresar" class="btn btn-lca">
                            <i class="fa fa-undo"></i>
                        </a>
                      
                    </div>
                      <div class="form-group col-xs-12 text-center"><h5><strong>Complete los campos requeridos <span style="color: red;">*</span> </strong></h5></div>                   
                </form>
            </div>

        </div>
    </div>
            </div>
</div>
</div>
<?php require_once("footer.php"); ?>
</div>
</div>
<script>
    $(document).ready(function() {
        
        $('#error').hide();
        $('#guardar_usuario').click(function(e) {
            e.preventDefault();

            //Expresiones Regulares
            expUsuario=/[a-zA-Z1-9]/;
            expcorreo=/\w+@\w+\.+[a-zA-Z]/;

            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var sexo = $('#sexo').val();
            var usuario = $('#usuario').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            var correo=$('#correo').val();
            var pregunta = $('#pregunta').val();
            var respuesta = $('#respuesta').val();
            
            if (nombre === "") {
                swal("Ingrese su nombre", "", "error");
                return false;
            }else if (apellido === "") {
                swal("Ingrese su apellido", "", "error");
                return false;
            }else if (sexo === "") {
                swal("Seleccione un sexo", "", "error");
                return false;
            } else if (usuario === "") {
                swal("Ingrese su nombre de usuario", "", "error");
                return false;
            }else if (password === "") {
                swal("Ingrese su password", "", "error");
                return false;
            }else if (confirm_password === "") {
                swal("Confirme el password", "", "error");
                return false;
            } else if (password != confirm_password) {
                swal("No coinciden los password", "", "error");
                return false;
            }else if(correo === ""){
                swal("Ingrese el correo Electronico para continuar","","error");
                return false;
            }else if(!expcorreo.test(correo)){
                swal("Formato invalido example@hotmail.com","","error");
                return false;
            }else if (pregunta === "") {
                swal("Seleccione una pregunta", "", "error");
                return false;
            }else if (respuesta === "") {
                swal("Ingrese su respuesta secreta", "", "error");
                return false;
            }else {
                $.ajax({
                    url: "usuarios/addusuario.php",
                    type: "POST",
                    data: $('#form_usuario').serialize(),
                    success: function(data) {
                        $('#mensajes').html(data);
                        

                    }
                });
            }
        });
    });

</script>
