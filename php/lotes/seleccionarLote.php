<?php
    require_once("../../config/conexion.php");
    $id = $_GET['id'];

    $verificarlote2=$con->query("SELECT * FROM inventario INNER JOIN lotes ON inventario.lotes_id = lotes.id_lote WHERE inventario.productos_id = '$id' AND status_inventario = 'Pendiente' ORDER BY fechaVenc LIMIT 5");

    if($verificarlote2){
        if($verificarlote2->num_rows > 0){
            while($row = mysqli_fetch_array($verificarlote2)){
            echo'
                <tr>
                    <td>'.$row['codigo_lote'].'</td>
                    <td>'.$row['fechaEnt'].'</td>
                    <td>'.$row['fechaVenc'].'</td>
                    <td>'.$row['cantidad'].'</td>
                    <td><a href="##" onclick="recargarLote(\''.$row['lotes_id'].'\',\''.$row['productos_id'].'\');" title="Recargar este lote" class="btn btn-success recargarLote-btn" disabled><i class="fa fa-plus"></i></a></td>
                </tr>';
            }
        }else{
            $Resultado[] = [
                'lotesEncontrados' => false,
            ];
            json_encode($Resultado);
        }
    }

?>