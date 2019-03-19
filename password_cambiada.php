<?php 
session_start();
if(isset($_SESSION['id_usuario'])){
    header("location:php/inicio.php");
}else if(!isset($_SESSION['recuperarPass'])){
    header('location:index.php');
}
session_destroy();
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
    <link rel="stylesheet" href="public/css/login-clp2.css">
    <link rel="stylesheet" href="public/css/sweetalert.css">
    <link rel="stylesheet" href="public/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/animate.css">
</head>

<body>

    <div class="main">
        <div id="mensaje"></div>
        <div class="content_formulario" style="">
            <div class="container">
               <div class=""></div>
                <h3 class="tittle-newpass"> Recuperar contraseña</h3>                                   
                <hr>
                <div class="logopasscontent">
                    <div class="text-center">
                        <img src="public/multimedia/1490268935705.jpg" alt="logo de la clinica" title="logo de la empresa" width="180px" class="logopass">
                        <br/>
                        <br/>
                        <div class="formpass text-center">
                           <h4>¡Proceso exitoso, contraseña cambiada correctamente!</h4>
                           <br>
                           <a href="index.php" class="btn btn-primary">iniciar sesion</a>
                        </div>
                        <div class="progreso">
                        <center><h3>Completado</h3></center>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="img-newpass">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"><img src="public/multimedia/recuperada-contraseña.png" alt="" class="imglogin" height="185px" width="225"></div>
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

            var usuariopass = $('#username');

            $('.recuperar').click(function(e) {
                e.preventDefault();
                var usuario = $('#username').val();          
                if (usuario === "") {
                    swal("Ingrese un usuario activo", "", "error");
                    return false;
                } else {
                    $.ajax({
                        url: "config/passuser.php",
                        type: "POST",
                        data: $('#userpassform').serialize(),
                        success: function(data) {
                            $('#mensaje').html(data);
                        }
                    });
                }
            });

            setTimeout(function() {
                $('.tittle-login').addClass('animated jackInTheBox');
                $('.imglogin').addClass('animated pulse');
                $('.minlogofooter').addClass('animated shake');
                $('.logopass').addClass('animated bounce');
            }, 350);

            usuariopass.focus(function() {
                if (usuariopass.val() == '') {
                   $('#recuperar').attr('disabled', '');
                }
            });


            usuariopass.keypress(function() {
                if (usuariopass.val().length == '0') {
                    $('#recuperar').removeAttr('disabled');
                }
            });


            usuariopass.blur(function(e) {
                if (usuariopass.val().length == 0) {
                    $('#recuperar').attr('disabled', '');
                } else {
                    $('#recuperar').removeAttr('disabled');
                }
            });

            $('.btn-warning').mouseover(function() {
                $(this).addClass('animated pulse');
            });

            $('.btn-warning').mouseout(function() {
                $(this).removeClass('animated pulse');
            });

        });

    </script>
</body>

</html>
