<div class="table-responsive">
                        <table id="tabla" class="table display">
                            <thead>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Usuario</th>
                                <th>Nivel Usuario</th>
                                <th>Status</th>
                                <th>Operaciones</th>
                            </thead>
                            <tbody>
                                <?php while($row=mysqli_fetch_array($result)){ ?>
                                <tr>
                                    <td>
                                        <?php echo $row['nombre']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['apellido']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['usuario']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['tipo']; ?>
                                    </td>
                                     <td><center><?php if($row['status']==='activo'){ ?><button style="" title="Activo" type="button" class="btn btn-success" ><i class="fa fa-chevron-up"></i></button>
                                <?php }else{ ?>
                                    <button type="button" title="inactivo" class="btn btn-danger" ><i class="fa fa-chevron-down"></i></button><?php } ?>
                                    </center></td>
                                    <td>
                                        <a href="#" title="Ver datos del usuario" onclick="verusuario('<?php echo $row['nombre']; ?>','<?php echo $row['apellido']; ?>','<?php echo $row['sexo']; ?>','<?php echo $row['usuario']; ?>','<?php echo $row['tipo']; ?>','<?php echo $row['correo']; ?>','<?php echo $row['pregunta_secreta']; ?>');" data-target="#verusuario" class="btn btn-info" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                        <a href="editarusuario.php?id=<?php echo $row['id_usuario']; ?>"  title="Editar usuario" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                                        <a title="Eliminar usuario" href="javascript:eliminar_usuario('<?php echo $row['id_usuario']; ?>');" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>