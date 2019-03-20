<?php
require_once("../config/conexion.php");
$pacientes=$con->query("SELECT COUNT(*) FROM pacientes WHERE status='activo'");
$chartpac=mysqli_fetch_array($pacientes);
$doctores=$con->query("SELECT COUNT(*) FROM doctores WHERE status='activo'");
$chartdoc=mysqli_fetch_array($doctores);
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
                    <div class="col-sm-12">
                        <div class="cards">
                            <div class="card">
                                <div class="card-content bg_md">
                                    <a href="citascalendario.php"><i class="fa fa-address-book-o"></i> <span>Nueva Consulta</span></a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content bg_gf">
                                    <a href="pacientes.php"><i class="fa fa-heartbeat"></i><span>Pacientes</span></a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content bg_txt_aq">
                                    <a href="doctores.php"><i class="fa fa-user-md"></i> <span>Doctores</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
require_once('footer.php');
?>
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

