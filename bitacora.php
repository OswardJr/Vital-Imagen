<?php
    require_once('header.php');
?>
    <!--El contenido maldito leo tiene que ir aqui en una etiqueta pagewrapper-->
    <?php
    /*Datos de los graficos*/
    require_once("../config/conexion.php");
    $productos=$con->query("SELECT COUNT(*) FROM productos WHERE status_producto='activo'");
    $chartpro=mysqli_fetch_array($productos);
    $categorias=$con->query("SELECT COUNT(*) FROM categorias WHERE status_categoria='activo' ");
    $chartcat=mysqli_fetch_array($categorias);
    $pacientes=$con->query("SELECT COUNT(*) FROM pacientes WHERE status='activo'");
    $chartpac=mysqli_fetch_array($pacientes);
    $especialidad=$con->query("SELECT COUNT(*) FROM especialidades");
    $chartesp=mysqli_fetch_array($especialidad);
    $doctores=$con->query("SELECT COUNT(*) FROM doctores WHERE status='activo'");
    $chartdoc=mysqli_fetch_array($doctores);
    $proveedores=$con->query("SELECT COUNT(*) FROM proveedores WHERE status_proveedor='activo'");
    $chartprove=mysqli_fetch_array($proveedores);
?>
        <div class="page-content">
            <div class="bread-content">
                <div class="container">
                    <h4>Inicio</h4>
                    <span class="breadcoumb"><i class="fa fa-home"></i> Inicio</span>
                </div>
            </div>
            <!--Aqui se maqueta-->
            <div class="container-fluid">
    
               

                <!--Tiene que ser cerrado con 2 div-->
            </div>
            <?php
    require_once('footer.php');
?>
        </div>
        <script>
            var productos = <?php echo ($chartpro[0]);?>;
            var pacientes = <?php echo ($chartpac[0]);?>;
            var categorias = <?php echo ($chartcat[0]);?>;
            var especialidad = <?php echo ($chartesp[0]);?>;
            var doctores = <?php echo ($chartdoc[0]);?>;
            var citas = <?php echo ($citaprog[0]);?>;
            var proveedores = <?php echo ($chartprove[0]);?>;

        </script>
        <script>
            $(document).ready(function(){
               /* var height=$('.log-box>.height2').height();
                var height2=$('.log-box>.height1').css('height',height);
*/
            });
        </script>
