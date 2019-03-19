<?php
require("conexion.php");
$id=$_POST['id'];
$password=$_POST['password'];
$sha1=sha1($password);
$con_password=$_POST['con_password'];
$sql="UPDATE usuarios SET password='$sha1' WHERE id_usuario='$id'";
$result=$con->query($sql);
echo '<script> swal({
                        title: "Password Guardado con exito",
                        text: "Redireccionando...",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "index.php"; }, delay);</script>';
