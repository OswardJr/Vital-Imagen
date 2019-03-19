<?php 
session_start();
if(isset($_SESSION['id_usuario'])){
    header("location:php/inicio.php");
}else if(!isset($_SESSION['recuperarPass'])){
    header('location:index.php');
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
    <link rel="stylesheet" href="public/css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/animate.css">
</head>

<body>

    <div class="main">
        <div id="mensaje"></div>
        <div class="content_formulario" style="">
            <div class="container">
               <div class=""></div>
                <h3 class="tittle-newpass"> Recuperar contraseña <a href="index.php" class=""><i class="fa fa-times"></i></a></h3>                                   
                <hr>
                <div class="logopasscontent">
                    <div class="text-center">
                        <img src="public/multimedia/1490268935705.jpg" alt="logo de la clinica" title="logo de la empresa" width="180px" class="logopass">
                        <br/>
                        <br/>
                        <br/>
                        <div class="formpass">
                            <form action="" id="userpassform" autocomplete="on" class="form-inline">
                            <div class="row text-center">
                                <div class="form-group col-xs-12  col-md-6 col-lg-6">
                                    <label for=""><h4><i class="fa fa-key"></i> Nueva contraseña </h4></label>
                                    <input type="password" name="pass" id="pass" class="form-control" placeholder="Ingrese la contraseña">
                                </div>
                                <input type="hidden" name="usuario" value="<?php echo $_SESSION['recuperarPass']; ?>">
                                <div class="form-group col-xs-12 col-md-6 col-lg-6">
                                    <label for=""><h4><i class="fa fa-lock"></i> Repetir contraseña </h4></label>
                                    <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Confirmar contraseña">
                                <br class="hidden-lg hidden-md">
                                  <button type="submit" disabled class="btn btn-warning recuperar" id="recuperar"><i class="fa fa-check"></i></button>
                                  </div>
                                  </div>
                            </form>
                        </div>
                        <div class="progreso">
                        <center><h3>Paso 3 de 3</h3></center>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                 <hr>
                <div class="img-newpass">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"><img src="public/multimedia/seguridad2.png" alt="" class="imglogin" height="180px" width="200"></div>
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

            var pass1 = $('#pass');
            var pass2 = $('#pass2');

            $('.recuperar').click(function(e) {
                e.preventDefault();
                var password = pass1.val(); 
                var password2 = pass2.val();         
                if (password === "" || password2 === "") {
                    swal("Verifique los campos", "no se permiten campos vacios", "error");
                    return false;
                }else if(password.length < 6 || password2.length < 6){
                    swal("Error", "Contraseña demasiado corta", "error");
                    return false;
                }else if(password.length > 12 || password2.length > 12){
                    swal("Error", "Contraseña demasiado larga", "error");
                    return false;
                }else if(password2 != password){
                    swal("Error", "Las contraseñas deben coincidir", "error");
                    return false;
                } else {
                
                    $.ajax({
                        url: "config/changepass.php",
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

            pass1.focus(function() {
                if (pass1.val() == '' && pass2.val() == '') {
                   $('#recuperar').attr('disabled', '');
                }
            });

            pass2.focus(function() {
                if (pass1.val() == '' && pass2.val() == '') {
                   $('#recuperar').attr('disabled', '');
                }
            });

            pass1.keypress(function() {
                if (pass1.val().length == '0' && !pass2.val().length == '0') {
                    $('#recuperar').removeAttr('disabled');
                }
            });

            pass2.keypress(function() {
                if (!pass1.val().length == '0' && pass2.val().length == '0') {
                    $('#recuperar').removeAttr('disabled');
                }
            });

            pass1.blur(function(e) {
                if (pass1.val().length == 0 || pass2.val().length == 0) {
                    $('#recuperar').attr('disabled', '');
                } else {
                    $('#recuperar').removeAttr('disabled');
                }
            });

            pass2.blur(function(e) {
                if (pass1.val().length == 0 || pass2.val().length == 0) {
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
