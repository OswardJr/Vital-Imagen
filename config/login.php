<?php 
require_once("conexion.php");
if(isset($_SESSION['id_usuario'])){
	header("location:php/inicio.php");
}
if(!empty($_POST)){
$usuario=$_POST['usuario'];
$password=$_POST['password'];
$sha1_pass=sha1($password);

$sql="SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$sha1_pass'";
$result=$con->query($sql);
$rows=$result->num_rows;
$fetch=$result->fetch_assoc();

if(!$usuario && !$password){
	echo "Todo los campos Requeridos";
}else if(!$usuario){
	echo "Ingrese su nombre de usuario";
}else if(!$password){
	echo "Ingrese su Password";
}else if($rows==0){
	echo '<script> swal({
                        title: "¡Autenticacion fallida!",
                        text: "Correo y o password incorrectos",
                        type: "error"
                    });
                    </script>';
}else{
	session_start();
	$_SESSION['id_usuario']=$fetch['id_usuario'];
	echo '<script> swal({
                        title: "¡Autenticacion Exitosa!",
                        text: "",
                        type: "success",
                        timer: 800,
                        showConfirmButton: false
                    });

                var delay = 800;
                setTimeout(function(){ window.location = "php/inicio.php"; }, delay);</script>';
}

}

 ?>