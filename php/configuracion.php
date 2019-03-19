
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

            <form action="guardar_configuracion.php" method="POST">

                <div class="row">
                    <div class="col-xs-6">
                          <div class="box-configuration">
                              <h3>Interfaz</h3>
                              <div class="box text-center">
                              <label for="ampliar"><h5>Pantalla grande</h5></label>
                              <br>
                              <label class="switch">
                              <input type="checkbox" name="ampliar" value="1" " id="ampliar"
                                    <?php
                                        if (isset($_COOKIE['template'])) {
                                            if($_COOKIE['template'] == '1'){
                                                echo 'checked';
                                            }
                                        }
                                    ?>

                               >
                              <span class="slider round"></span>
                            </label> 
                              </div>  
                            <div class="box colores" style="">
                              <h5>Color del menu</h5>
                              <div class="labels" style="display: flex;margin-top: 20px; flex-wrap: wrap; justify-content: space-around;">
                              <div class="color">
                                <label for="negro" class="<?php
                                        if (isset($_COOKIE['colorTemplate'])) {
                                            if($_COOKIE['colorTemplate'] == 'negro'){
                                                echo 'colorSeleccionado';
                                            }
                                        }
                                    ?>" style="background:#303030 !important; width:20px; height: 20px;"></label>
                              <input type="radio" class="hidden cambiarColor" id="negro" value="negro" name="colorTemplate" >
                              </div>
                              <div class="color">
                                <label for="azul" class="<?php
                                        if (isset($_COOKIE['colorTemplate'])) {
                                            if($_COOKIE['colorTemplate'] == 'azul'){
                                                echo 'colorSeleccionado';
                                            }
                                        }
                                    ?>" style="background:#256 !important; width:20px; height: 20px;"></label>
                              <input type="radio" class="hidden cambiarColor" id="azul" value="azul" name="colorTemplate" >
                              </div>
                              <div class="color">
                                <label for="teal" class="<?php 
                                   if (!isset($_COOKIE['colorTemplate'])) {
                                                echo 'colorSeleccionado';
                                        }
                                ?>"  style="background:teal !important; width:20px; height: 20px;"></label>
                              <input type="radio" class="hidden cambiarColor" id="teal" value="" name="colorTemplate" style="background: teal !important;">
                              </div>
                              </div>
                          </div> 
                          </div>
                    </div>
                </div>
                <div class="botones-formulario text-center" style="width: 100%;margin-top:20px;">
                    <input type="submit" name="guardar_configuracion" value="Guardar" class="btn">
                </div>
        
            </form>
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

