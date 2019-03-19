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
                <h3 class="tittle-newpass"> Recuperar contraseña <a href="index.php" class=""><i class="fa fa-undo"></i></a></h3>                                   
                <hr>
                <div class="logopasscontent">
                    <div class="text-center">
                        <img src="public/multimedia/1490268935705.jpg" alt="logo de la clinica" title="logo de la empresa" width="180px" class="logopass">
                        <br/>
                        <br/>
                        <div class="formpass">
                            <form action="" id="userpassform" autocomplete="on" class="form-inline">
                                <div class="form-group">
                                    <label for=""><h4><i class="fa fa-user"></i> Usuario: </h4></label>
                                    <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese su correo">
                                    <br class="hidden-lg hidden-md">
                                    <button type="submit" disabled class="btn btn-warning recuperar" id="recuperar"><i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="progreso">
                        <center><h3>Paso 1 de 3</h3></center>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 1%">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="img-newpass">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6 text-center"><img src="public/multimedia/olvido-contrasena.png" alt="" class="imglogin" height="200px" width="200"></div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6 textolvido text-center">
                            <h4>¡Oops ¿Ha olvidado su contraseña?! <br>Descuide le proporcionaremos los recursos necesarios para recuperarla y pueda ejercer de nuevo sus funcionalidades dentro del sistema sin ninguna complicacion.</h4>
                        </div>
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

            var usuariopass = $('#usuario');

            $('.recuperar').click(function(e) {
                e.preventDefault();
                var usuario= $('#usuario').val(); 
                var expusuario=/[a-zA-Z1-9]/;         
                if (usuario === "") {
                    swal("Ingrese un usuario activo", "", "error");
                    return false;
                }else if(!expusuario.test(usuario)){
                    swal("El campo usuario solo admite numeros y letras","","error");
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
