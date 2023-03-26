<?php

include("../../db.php");

//Envio de parametros a traves de la URL en el metodo GET
//METODO DELETE
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conn -> prepare("DELETE FROM tbl_almacen WHERE id=:id");
    $sentencia -> bindParam(":id",$txtID);
    $sentencia -> execute();
    Header("Location:index.php");

}

/* SUBCONSULTA PARA SACAR EL VALOR DE PUESTO*/
$sentencia = $conn -> prepare("SELECT *, 
(SELECT rack FROM tbl_racks WHERE tbl_racks.id=tbl_almacen.idubicacion limit 1) as rack 
FROM `tbl_almacen`");
$sentencia -> execute();
$lista_tbl_racks = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
?>
<?php
include("../../templates/header.php");
?>
<br>
<h4>Inventario Producción</h4>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" 
        href="create.php" role="button">
        Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col"># de Pieza</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">QR</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($lista_tbl_racks as $registro) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id']; ?></td>
                        <td><?php echo $registro['numdepieza']; ?></td>
                        <td><?php echo $registro['cliente']; ?></td>
                        <td><?php echo $registro['cantidad']; ?></td>
                        <td><?php echo $registro['rack']; ?></td>
                        <td>
                        <?php echo "<img src='" . $registro['qr_code'] . "'>"; ?> <br>
                        <a href="<?php echo $registro['qr_code']; ?>"><?php echo $registro['numdepieza']; ?></a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="see.php?txtID=<?php echo $registro['id']; ?>" role="button">Ver</a>
                            <a class="btn btn-info" href="edit.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                            <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']; ?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php
include("../../templates/footer.php");

?>