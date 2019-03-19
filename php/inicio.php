 <!--El contenido maldito leo tiene que ir aqui en una etiqueta pagewrapper-->
    <?php
    /*Datos de los graficos*/
    require_once("../config/conexion.php");
    $categorias=$con->query("SELECT * FROM categorias WHERE status_categoria='Activo' ");
    $pacientes=$con->query("SELECT COUNT(*) FROM pacientes WHERE status='activo'");
    $chartpac=mysqli_fetch_array($pacientes);
    $especialidad=$con->query("SELECT COUNT(*) FROM especialidades");
    $chartesp=mysqli_fetch_array($especialidad);
    $doctores=$con->query("SELECT COUNT(*) FROM doctores WHERE status='activo'");
    $chartdoc=mysqli_fetch_array($doctores);
    $proveedores=$con->query("SELECT COUNT(*) FROM proveedores WHERE status_proveedor='activo'");
    $chartprove=mysqli_fetch_array($proveedores);
    $sql7="SELECT * FROM bitacora INNER JOIN usuarios ON bitacora.usuario_id = usuarios.id_usuario WHERE status='Activo' ORDER BY id_bitacora DESC LIMIT 3";
    $result7=$con->query($sql7);
    $bitacoracomp=$con->query("SELECT * FROM bitacora");
?>
       
<?php
    require_once('header.php');
?>
        <div class="page-content">
            <!--Aqui se maqueta-->
            <div class="container-fluid">
                <div class="row content-bread-row">
                <div class="col-xs-7 bread-content">
                    <h4>Inicio</h4>
                    <span class="breadcoumb"><i class="fa fa-home"></i> Inicio</span>
                </div>
                <div class="col-xs-5">
                    <form action="evaluarPaciente.php" class="form-inline" id="enviarCedula" method="post" autocomplete="on">
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
                <div class="row">
                    <div class="col-lg-6 text-center">
                       <div class="panel panel-default logoinicio">
                        <div class="panel-heading">
                            <h3><i class="fa fa-ambulance"></i> Sistema administrativo</h3>
                        </div>
                        <div class="panel-body">
                        <div class="logo">
                            <img src="../public/multimedia/1490268935705.jpg" class="img-responsive" id="logoImg" style="">
                        </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cards">
                            <div class="card">
                                <div class="card-content bg_md">
                                    <a href="citascalendario.php"><i class="fa fa-calendar"></i><span>Citas para hoy: <?php echo $citaprog[0];?></span></a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content bg_gf">
                                    <a href="configuracion.php"><i class="fa fa-spin fa-cog"></i><span>Configuracion</span></a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content bg_txt_aq">
                                    <a href="pacientes.php"><i class="fa fa-heartbeat"></i><span>Pacientes Registrados: <?php echo $chartpac[0]; ?></span></a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content bg_txt_gf">
                                    <a href="bitacora.php"><i class="fa fa-history"></i><span>Bitacora</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">    
                <?php
                    if($categorias->num_rows > 1){
                ?>                                 
                    <div class="<?php
                        if($bitacoracomp->num_rows > 3){
                            echo 'col-lg-5';
                        }else{
                            echo 'col-lg-12';
                        }
                    ?> col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Productos en el inventario</h3>
                            </div>
                            <div class="panel-body text-center">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                        if($bitacoracomp->num_rows > 3){
                    ?>
                    <div class="col-lg-7 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                    <h3>Reciente</h3>
                            </div>
                            <div class="panel-body recientes">
                                <ul class="list-group">
                                   <?php 
                                    while($bitacora=mysqli_fetch_array($result7)){
                                    ?>
                                    <li class="list-group-item" id=""><img src="../public/multimedia/<?php if ($bitacora['sexo']=='Masculino'){ echo 'img_avatar2.png';}else{echo 'img_avatar6.png';}?>" alt=""><span><?php echo $bitacora['nombre'];?> </span><?php echo $bitacora['descripcion'];?></li>
                                    <?php }?>
                                </ul>
                                <a href="bitacora.php" class="btn btn-100w"><i class="fa fa-sign-in"></i> Ver bitacora</a>
                            </div>
                        </div>
                    </div>
                        <?php  }?>
                </div>
            </div>
        </div>
            <?php
    require_once('footer.php');
?>
        <script>
         $(document).ready(function(){
        $.get('productos/getProductos.php',function(data){
        var myProducto = JSON.parse(data);
        var chart = c3.generate({
            bindto: '#chart',
            data: {
                columns: myProducto,
            type : 'pie',
            colors: {
                'Medicam': 'red',
                'Equipo mgico': 'green',
            },
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
            }
        });     
        });
        });   

    </script>
    <script>
        $(document).ready(function(){

            $('#comprobarPaciente').click(function(){
               var cedula = $('#cedula').val();
               if(cedula == ''){
                   swal('Debe ingresar un numero de cedula','por favor utilice un formato valiido','error');
                   return false;
               }
            });
        });
    </script>

