<?php 
require_once("header.php");
 ?>
<div class="page-content">
    <div class="bread-content">
 <div class="container">
            <h4>Editar usuario</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Usuarios <i class="fa fa-caret-right"></i> Editar usuario</span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row" style="margin-top: 10px;">
        	<div class="col-xs-12 col-xs-offset-">
            <div class="col-xs-12 col-xs-offset-">
               <div id="mensajes"></h5></center></div>
        		<div class="panel panel-default">
        			<div class="panel-heading">
        				<center><h3 style="">Editar Usuario</h3></center>
        			</div>
                      <?php require_once("../config/conexion.php"); 
                        $sql="SELECT * FROM tipo_usuario";
                        $result=$con->query($sql);
                        

                        $id=$_GET['id'];
                        $sql2="SELECT u.*,t.id_tipo,t.tipo FROM usuarios AS u INNER JOIN tipo_usuario AS t ON u.id_tipo=t.id_tipo WHERE u.id_usuario='$id'";
                        $result2=$con->query($sql2);
                        $row2=$result2->fetch_assoc();
                    ?>
        			<div class="panel-body">
        				<form action="" class="" id="form_usuario">
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre <span style="color: red;">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" value="<?php echo $row2['nombre']; ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Apellido">Apellido <span style="color: red;">*</span></label>
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="" value="<?php echo $row2['apellido']; ?>">
                            </div> 
                             <div class="form-group col-md-4">
                        <label for="sexo">Sexo <span style="color: red;">*</span></label>
                        <select name="sexo" id="sexo" class="form-control">
                                  <option value="Masculino"<?php if($row2['sexo']=='Masculino') echo 'selected' ?>>Masculino</option>
                                  <option value="Femenino"<?php if($row2['sexo']=='Femenino') echo 'selected' ?>>Femenino</option>
                                  <option value="Indefinido"<?php if($row2['sexo']=='Indefinido') echo 'selected' ?>>Indefinido</option>
                              </select>
                    </div>   
                            <div class="form-group col-md-4">
                                <label for="usuario">Usuario <span style="color: red;">*</span></label>
                                <input type="text" name="usuario" id="usuario" class="form-control" placeholder="" value="<?php echo $row2['usuario']; ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="id_tipo">Nivel de Usuario <span style="color: red;">*</span></label>
                              <select name="id_tipo" id="id_tipo" class="form-control">
                                <option value="">Seleccione el Nivel de Usuario</option>
                                  <?php while($row=$result->fetch_assoc()){ ?>
                                  <option value="<?php echo $row['id_tipo']; ?>"<?php if($row['id_tipo']===$row2['id_tipo']) echo 'selected'; ?>><?php echo $row['tipo']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>      
                            <div class="form-group col-md-4">
                                <label for="password">Password <span style="color: red;">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" value="<?php echo $row2['password']; ?>">
                            </div>     
                            <div class="form-group col-md-4">
                                <label for="confirm_password">Confirm Password <span style="color: red;">*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo $row2['password'] ?>">
                            </div> 
                             <div class="form-group col-md-4">
                                <label for="correo_electronico">Correo Electronico</label>
                                <input type="text" name="correo" id="correo" class="form-control" placeholder="example@gmail.com" value="<?php echo $row2['correo']; ?>">
                            </div>

                         <div class="form-group col-md-4">
                        <label for="pregunta">Pregunta secreta <span style="color: red;">*</span></label>
                        <select name="pregunta" id="pregunta" class="form-control">
                                 <option value="">Seleccione una pregunta</option>
                                 <option value="Nombre de tu mascota?"<?php if($row2['pregunta_secreta']==='Nombre de tu mascota?')echo 'selected'; ?>>Nombre de tu mascota?</option>
                                 <option value="Color favorito?"<?php if($row2['pregunta_secreta']==='Color favorito?') echo 'selected'; ?>>Color favorito?</option>
                                 <option value="Nombre de tu mejor amigo de la infancia?"<?php if($row2['pregunta_secreta']==='Nombre de tu mejor amigo de la infancia?') echo 'selected'; ?>>Nombre de tu mejor amigo de la infancia?</option>  
                                 <option value="Nombre de tu abuela materna?"<?php if($row2['pregunta_secreta']==='Nombre de tu abuela materna?') echo 'selected'; ?>>Nombre de tu abuela materna?</option>
                                 <option value="Equipo de futbl favorito?"<?php if($row2['pregunta_secreta']==='Equipo de futbol favorito?') echo 'selected'; ?>>Equipo de futbol favorito?</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="respuesta">Respuesta secreta <span style="color: red;">*</span></label>
                        <input type="text" name="respuesta" id="respuesta" class="form-control" placeholder="Ingrese su respuesta" value="<?php echo $row2['respuesta_secreta']; ?>">
                        </div>
                         <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="activo"<?php if($row2['status']==="activo")echo 'selected'; ?>>Activo</option>
                                    <option value="inactivo"<?php if($row2['status']==="inactivo")echo 'selected'; ?>>Inactivo</option>
                                </select>
                            </div>

                            <div class="botones-formulario col-md-12 text-center">
                            <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $row2['id_usuario']; ?>">
                               <center>
                                 <button type="submit" id="editar_usuario" title="Editar Usuario" name="editar_usuario" class="btn btn-lca">
                                    <i class="fa fa-save"></i>
                                </button>
                                <a href="usuarios.php" title="Regresar" class="btn btn-lca "><i class="fa fa-undo"></i></a>
                               
                                </center>
                            </div> 
                            <div class="col-xs-12 text-center instruccions"><h5>Todos los campos requeridos <span style="color: red;">*</span></h5></div>                     
                        </form>
        			</div>
        		</div>
        	</div>
        </div>
</div>
</div>
 <?php require_once("footer.php"); ?>
 <script>
     $(document).ready(function(){
        $('#error').hide();
        $('#editar_usuario').click(function(e){
              e.preventDefault();
            
           expUsuario=/[a-zA-Z1-9]/;
            expcorreo=/\w+@\w+\.+[a-zA-Z]/;

            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var sexo = $('#sexo').val();
            var usuario = $('#usuario').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            var correo=$('#correo').val();
            var id_tipo = $('#id_tipo').val();
            var pregunta = $('#pregunta').val();
            var respuesta = $('#respuesta').val();
            if (nombre === "") {
                swal("Ingrese su nombre", "", "error");
                return false;
            }else if(!isNaN(nombre)){
                swal("Solo admite letras el nombre","","error");
                return false;
            }else if(nombre.length>20){
                swal("El maximo de caracteres para el nombre es 20","","error");
                return false;
            }else if (apellido === "") {
                swal("Ingrese su apellido", "", "error");
                return false;
            }else if(!isNaN(apellido)){
                swal("Solo admite letras el apellido","","error");
                return false;
            }else if(apellido.length>20){
                swal("El maximo de caracteres para el apellido es 20","","error");
                return false;
            }else if (sexo === "") {
                swal("Seleccione un sexo", "", "error");
                return false;
            } else if (usuario === "") {
                swal("Ingrese su nombre de usuario", "", "error");
                return false;
            }else if(!expUsuario.test(usuario)){
                swal("Solo admite numeros y letras el nombre de usuario","","error");
                return false;
            }else if(usuario.length>15){
                swal("El maximo de caracteres para el nombre de usuario es 15","","error");
                return false;
            }else if (id_tipo === "") {
                swal("Seleccione el privilegio del usuario", "", "error");
                return false;
            } else if (password === "") {
                swal("Ingrese su password", "", "error");
                return false;
            }else if(!expUsuario.test(password)){
                swal("Solo admite numeros y letras el password","","error");
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
            } else if(!expcorreo.test(correo)){
                swal("Formato invalido example@hotmail.com","","error");
                return false;
            }else if(correo.length>30){
                swal("El maximo de caracteres del correo es de 30","","error");
                return false;
            }else if (pregunta === "") {
                swal("Seleccione una pregunta", "", "error");
                return false;
            }else if (respuesta === "") {
                swal("Ingrese su respuesta secreta", "", "error");
                return false;
            } else if(!isNaN(respuesta)){
                swal("Solo admite letras la respuesta secreta","","error");
                return false;
            }else if(respuesta.length>20){
                swal("El maximo de caracteres que admite la respuesta son 20","","error");
                return false;
            }else {
            $.ajax({
                url:"usuarios/editusuario.php",
                type:"POST",
                data:$('#form_usuario').serialize(),
                success:function(data){
                    $('#mensajes').html(data);
                }
            });
}
        });
     });
 </script>