
<?php
    require_once("../config/conexion.php");
    require_once('header.php');
?>
        <div class="page-content">
            <!--Aqui se maqueta-->
            <div class="container-fluid">
            <div class="bread-content">
                <div class="container">
                    <h4>Configuracion</h4>
                    <span class="breadcoumb"><i class="fa fa-home"></i> Inicio</span>
                </div>
            </div>
            <br>

            <
                <!--Tiene que ser cerrado con 2 div-->
            </div>
            <?php
    require_once('footer.php');
?>
        </div>
        <script>
          $(document).ready(function(){
              $('.color input').change(function() {
                    if($(this).prop('checked')){
                      $('.colores .colorSeleccionado').removeClass('colorSeleccionado');
                      $(this).parent().find('label').addClass('colorSeleccionado');              
                    }
              });
          });
        </script>

