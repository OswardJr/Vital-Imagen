<?php
    require_once('header.php');
?>
    <!--El contenido maldito leo tiene que ir aqui en una etiqueta pagewrapper-->
    <?php
    /*Datos de los graficos*/
    require_once("../config/conexion.php");
    $cedula = $_POST['cedula'];
    $nacionalidad = $_POST['nacionalidad'];

    $cedulaCompleta = $nacionalidad.'-'.$cedula;

    $comprobarCedula = $con->query("SELECT * FROM pacientes WHERE ced_paciente = '$cedulaCompleta'");
?>
        <div class="page-content">
            <!--Aqui se maqueta-->
            <div class="container-fluid">
                <div class="row content-bread-row">
                <div class="col-xs-12 bread-content">
                    <h4>Inicio</h4>
                    <span class="breadcoumb"><i class="fa fa-home"></i> Inicio</span>
                </div>
                </div>
                        <?php
                            if($comprobarCedula->num_rows > 0){
                        ?>
                <div class="


                row">
                    <div class="col-xs-6 text-center">
                            <h4>Cedula:
                                <?php echo $cedulaCompleta;?></h4>
                                                   
                    </div>
                    <div class="col-xs-6 text-center">
                        <h4>¡Paciente encontrado!</h4>
                    </div>
                </div>
                            <div class="row">
                <div class="col-lg-6 text-center">
                    <?php 
                        $row = mysqli_fetch_array($comprobarCedula);
                        echo '<h4>Paciente: ',$row['nombres'].' '.$row['apellidos'].'</h4>';
                    ?>
                </div>
                <div class="col-xs-6 text-center">
                    <h4>¿Que desea hacer?</h4>
                </div>
            </div>
            <div class="row opcionesPaciente">
             <div class="col-xs-4">
                <a class="bg_gf" href="nuevacita2.php?ced=<?php echo $cedulaCompleta;?>">Registrar cita</a>
             </div>
             <div class="col-xs-4">
                <a class="bg_txt_gf" href="nuevaconsulta2.php?ced=<?php echo $cedulaCompleta;?>">Nueva consulta</a>
             </div>
             <div class="col-xs-4">
                <a class="bg_gc" href="nuevopresupuesto2.php?ced=<?php echo $cedulaCompleta;?>">Nuevo
                 Presupuesto</a>
             </div>
            </div>
             <?php }else{ ?>
             <div class="row">
                    <div class="col-xs-6 text-center">
                            <h4>Cedula:
                                <?php echo $cedulaCompleta;?></h4>
                                                   
                    </div>
                    <div class="col-xs-6 text-center">
                        <h4>¡Paciente no registrado!</h4>
                    </div>
                </div>
                            <div class="row opcionesPaciente">
             <div class="col-xs-6">
                <a class="bg_md" href="nuevopaciente.php?ced=<?php echo $cedulaCompleta;?>">Registrar paciente</a>
             </div>
             <div class="col-xs-6">
                <a id="otraCedula" class="bg_txt_aq" href="##">Buscar otra cedula</a>
             </div>
        
            </div>
               <div class="row formularioCedula hidden">
                <div class="col-xs-12 text-center">
                    <form action="<?php $_SERVER['PHP_SELF'];?>" class="form-inline" id="enviarCedula" method="post" autocomplete="on">
                       <label for="cedula">Buscar paciente:</label>
                        <div class="input-group">
                            <div class="input-group-btn">
                            <select name="nacionalidad" id="" class="form-control">
                                <option value="V">V</option>
                                <option value="E">E</option>
                            </select>
                            </div>
                  

                            <input type="text" id="cedula" name="cedula" class="form-control right-no-radius" placeholder="Introduce la cedula">
                            <span class="input-group-btn">
                            <button type="submit" id="comprobarPaciente" class="btn"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
               </div>
                <?php } ?>
            </div>

            <?php
    require_once('footer.php');
?>
        </div>
        <script>
            $(document).ready(function(){
               $('#otraCedula').click(function(){
                  $('.formularioCedula').removeClass('hidden'); 
               }); 
            });
        </script>

