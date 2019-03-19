<?php 
session_start();
if(isset($_SESSION['id_usuario'])){
    header("location:php/inicio.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Clínica la paz</title>
    <link rel="shortcut icon" type="image/x-icon" href="public/multimedia/favicon.ico" />
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/login-clp1.css">
    <link rel="stylesheet" href="public/css/sweetalert.css">
    <link rel="stylesheet" href="public/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/animate.css">
</head>

<body>

    <div class="main">
        <div class="logo">
            <div class="container">
                <img src="public/multimedia/1490268935705.jpg" alt="logo de la clinica" title="logo de la empresa" width="180px" class="logologin">
            </div>

        </div>
        <div id="mensaje"></div>
        <div class="content_formulario" style="">
            <div class="cabecera_login">
                <h3 class="tittle-login"> Iniciar Sesion</h3>
                <hr>
                <div class="contenedor">
                    <div class="img-login text-center">
                        <img src="public/multimedia/Login-avatar.png" alt="" width="200">
                    </div>
                    <div class="contenedor-inputs">
                           
                            <form class="form_login" id="formulario_login">
                               <div class="row">
                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <label for="email" class=""><h4><i class="fa fa-user"></i> Usuario</h4></label>
                                    <input style="border:transparent;" title="Ingresa tu usuario" type="text" class="form-control" placeholder="Introduce usuario" name="usuario" id="usuario">

                                </div>
                                <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <label for=""><h4><i class="fa fa-lock"></i> Contraseña </h4></label>
                                    <input style="border:transparent;" title="Ingresa tu contraseña" type="password" class="form-control" placeholder="Introduce tu contraseña" name="password" id="password">

                                </div>
                                <div class="linksform col-xs-12">
                                     <button type="submit" id="ingresar_form" title="Ingresar al sistema" class="btn btn-success enviar btn-form-link"><i class="fa fa-check"></i></button>
                                    <a href="recuperar.php" title="¿Olvido su contraseña?" class="btn btn-warning btn-form-link question"><i class="fa fa-lock"> </i><i class="fa fa-question"></i></a> 
                                </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <footer>
        <div class="footer">
            <div class="contenedor-no-flex">
                <center>
                    <h4><img src="public/multimedia/clinica-logo-min.png" height="30px" alt="" class="minlogofooter"> LCA La Cl&iacute;nica "LA PAZ"</h4>
                </center>
                <center>
                    <p>Municipio Jose Felix Ribas</p>
                </center>
                <center>
                    <p>La victoria, Aragua</p>
                </center>
            </div>
            <div class="footer-footer">
                <div class="contenedor-no-flex">
                    <center>Copyright &copy; Todos Los Derechos Reservados</center>
                </div>
            </div>
            <div class="creditos">
                <center>Web makers Cristian Valera, Leoncio Requena, Adrian Yaguaracuto</center>
                <center>Universidad Politecnica Territorial de Aragua (UPTA).</center>
            </div>
        </div>
    </footer>
    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src=public/js/sweetalert2.min.js></script>
    <script src="public/js/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
            $('#ingresar_form').click(function(e) {
                e.preventDefault();
                var usuario= $('#usuario').val();
                var expusuario=/[a-zA-Z0-9]/;
                var expass=/[a-zA-Z0-9]/;
                var password = $('#password').val();
                if (usuario === "") {
                    swal("Ingrese su nombre de usuario","","error");
                    return false;
                }else if(!expusuario.test(usuario)){
                    swal("El campo usuario solo admite numeros y letras","","error");
                } else if (password === "") {
                    swal("Ingrese su password","","error");
                    return false;
                }else if(!expass.test(password)){
                    swal("El  password solo admite numeros y letras","","error");
                    return false;
                } else {
                    $.ajax({
                        url: "config/login.php",
                        type: "POST",
                        data: $('#formulario_login').serialize(),
                        success: function(data) {
                            $('#mensaje').html(data);
                            $('#email').val("");
                            $('#password').val("");
                        }
                    });
                }
            });

             setTimeout(function() {
                 $('.tittle-login').addClass('animated jackInTheBox');
                 $('.img-login').addClass('animated pulse');
                 $('.minlogofooter').addClass('animated shake');
                 $('.logologin').addClass('animated bounce');
             }, 350);

           
            
            $('.btn-form-link.enviar').mouseover(function() {
                $(this).removeClass('slideInRight');
            });

            $('.btn-form-link').mouseover(function() {
                $(this).addClass('animated pulse');
            });

            $('.btn-form-link').mouseout(function() {
                $(this).removeClass('animated pulse');
            });

        });

    </script>
</body>

</html>
