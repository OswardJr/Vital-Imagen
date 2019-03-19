<?php
require("conexion.php");
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];
$sha1=sha1($pass);

$sql="UPDATE usuarios SET password='$sha1' WHERE usuario='$usuario'";
$result=$con->query($sql);
echo '<script> 
               window.location = "password_cambiada.php"; 
      </script>';

 ?>