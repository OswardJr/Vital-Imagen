<?php
    if (isset($_POST['guardar_configuracion'])) {

        if(isset($_POST['colorTemplate'])){
           $colorTemplate = $_POST['colorTemplate'];
           if($colorTemplate == 'negro'){
                 if(!isset($_COOKIE['colorTemplate'])){
                    setcookie("colorTemplate", $colorTemplate, time()+2678400);
                 }else{
                    setcookie("colorTemplate",$colorTemplate);
                 }
           }else if($colorTemplate == 'azul'){
                 if(!isset($_COOKIE['colorTemplate'])){
                    setcookie("colorTemplate", $colorTemplate, time()+2678400);
                 }else{
                    setcookie("colorTemplate",$colorTemplate);
                 }
           }else{
                if(isset($_COOKIE['colorTemplate'])){
                        setcookie("colorTemplate", '', time()-1); 
                }
           }

        }

        if(isset($_POST['ampliar'])){
            $ampliar = $_POST['ampliar'];
                    if(!isset($_COOKIE['template'])){
                        setcookie("template", $ampliar, time()+2678400);
                    }
            }else{
                    if(isset($_COOKIE['template'])){
                        setcookie("template", '', time()-1); 
                    }
        }

        header('location:configuracion.php');

        }
?>