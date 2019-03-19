<?php 
require_once("../../config/conexion.php");
$nombre_intervencion=$_POST['nombre_intervencion'];
$descripcion_intervencion=$_POST['descripcion_intervencion'];
$cantidad_quirofano=$_POST['cantidad_quirofano'];
$importe_quirofano=$_POST['importe_quirofano'];
$cantidad_oxigeno=$_POST['cantidad_oxigeno'];
$importe_oxigeno=$_POST['importe_oxigeno'];
$cantidad_reten=$_POST['cantidad_reten'];
$importe_reten=$_POST['importe_reten'];
$cantidad_hospitalizacion=$_POST['cantidad_hospitalizacion'];
$importe_hospitalizacion=$_POST['importe_hospitalizacion'];
$cantidad_medico=$_POST['cantidad_medico'];
$importe_medico=$_POST['importe_medico'];
$cantidad_enfermera=$_POST['cantidad_enfermera'];
$importe_enfermera=$_POST['importe_enfermera'];
$cantidad_balanceada=$_POST['cantidad_balanceada'];
$importe_balanceada=$_POST['importe_balanceada'];
$precio_total=$importe_quirofano+$importe_oxigeno+$importe_reten+$importe_hospitalizacion+$importe_medico+$importe_enfermera+$importe_balanceada;

$intervencion=$con->query("INSERT INTO intervencion(nombre_intervencion,descripcion_intervencion, cantidad_quirofano, importe_quirofano, cantidad_oxigeno,importe_oxigeno,cantidad_reten,importe_reten, cantidad_hospitalizacion, importe_hospitalizacion, cantidad_medico, importe_medico, cantidad_enfermera, importe_enfermera, cantidad_alimentacion, importe_alimentacion, precio_total) VALUES ('$nombre_intervencion','$descripcion_intervencion','$cantidad_quirofano','$importe_quirofano','$cantidad_oxigeno','$importe_oxigeno','$cantidad_reten','$importe_reten','$cantidad_hospitalizacion','$importe_hospitalizacion','$cantidad_medico','$importe_medico','$cantidad_enfermera','$importe_enfermera','$cantidad_balanceada','$importe_balanceada','$precio_total')");


$id_intervencion=mysqli_insert_id($con);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Inserto una intervención',NOW())";
$result3=$con->query($sql3);

echo '<script>swal({
                        title: "Intervención guardada con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                var delay = 2000;
                setTimeout(function(){ window.location = "intervencion.php"; }, delay);</script>';
 
if(isset($_POST['id_prof']) || isset($_POST['id_pro'])){

				$items1 = ($_POST['id_prof']);		
				$items2 = ($_POST['importe_profesional']);
				$items3 = ($_POST['id_pro']);
				$items4 = ($_POST['cantidad']);
				///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
				while(true) {

				    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
				    $item1 = current($items1);
				    $item2 = current($items2);
					$item3 = current($items3);
					$item4 = current($items4);
				    
				    ////// ASIGNARLOS A VARIABLES ///////////////////
				    $id_prof=(( $item1 !== false) ? $item1 : ", &nbsp;");
				    $importe_profesional=(( $item2 !== false) ? $item2 : ", &nbsp;");
				    $id_pro=(( $item3 !== false) ? $item3 : ", &nbsp;");
				    $cantidad=(( $item4 !== false) ? $item4 : ", &nbsp;");



				     $valores='('.$id_intervencion.',"'.$id_prof.'","'.$importe_profesional.'","'.$id_pro.'","'.$cantidad.'"),';
				
				
				    $valoresQ= substr($valores, 0, -1);

				
				    $sql2 = "INSERT INTO presupuesto_intervencion (id_intervencion,id_doctor,precio_doctor,id_producto,cantidad_producto) 
					VALUES $valoresQ";
					$sqlRes=$con->query($sql2);
			
					$item1 = next( $items1 );
					$item2 = next( $items2 );
					$item3 = next( $items3 );
					$item4 = next( $items4 );
					if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
    				
				}

				$deletepro=$con->query("DELETE FROM temp_productos");

               $deleteproF=$con->query("DELETE FROM temp_profesionales");

				foreach ($_POST['id_pro'] as $ids) {
					$idpro=mysqli_real_escape_string($con,$_POST['id_pro'][$ids]);
					$cantidad1=mysqli_real_escape_string($con,$_POST['cantidad'][$ids]);
				
		
					$descuentoproducto=$con->query("UPDATE productos SET stock=stock-'$cantidad1' WHERE id_producto='$ids' ");
				}

					
		}

?>
