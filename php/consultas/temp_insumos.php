<?php 
require("../../config/conexion.php");
$id_producto=$_POST['nombre_insumo'];
$cantidad=$_POST['cantidad'];
$temp=$con->query("INSERT INTO temp_productos(id_producto,cantidad) VALUES('$id_producto','$cantidad')");
$buscar=$con->query("SELECT * FROM productos WHERE id_producto='$id_producto'");
$fetch=mysqli_fetch_assoc($buscar);
$menos=$fetch['stock'];
$total=$menos-$cantidad;
$update=$con->query("UPDATE productos SET stock='$total'");
$sql=$con->query("SELECT p.*,t.cantidad FROM temp_productos AS t INNER JOIN productos AS p ON t.id_producto=p.id_producto GROUP BY t.id_producto");

	while($row=mysqli_fetch_array($sql)){
		echo '<tr>
					<td>'.$row['nombre_producto'].'</td>
					<td>'.$row['cantidad'].'</td>
					<td>'.$row['precio'].'</td>
					 <td><input type="hidden" value="'.$row['id_producto'].'" name="id_pro['.$row['id_producto'].']"><input type="hidden" value="'.$row['cantidad'].'" name="cantidad['.$row['id_producto'].']"></td>
					<td><a class="btn btn-danger" href="javascript:eliminar_producto('.$row['id_producto'].')"><span class="fa fa-trash"></span></a></td>
				</tr>';
	}

 ?>
