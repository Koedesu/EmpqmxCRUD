<?php

include("../../db.php");

//Envio de parametros a traves de la URL en el metodo GET
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
  
    $sentencia = $conn -> prepare("SELECT * FROM tbl_almacen WHERE id=:id");
    $sentencia -> bindParam(":id",$txtID);
    $sentencia -> execute();
  
    $registro = $sentencia -> fetch(PDO::FETCH_LAZY);
  
    $numdepieza = $registro["numdepieza"];
    $cliente = $registro["cliente"];
    $cantidad = $registro["cantidad"];
    $ubicacion = $registro["ubicacion"];
    $qr_code = $registro["qr_code"];
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
                    <td><?php echo $numdepieza?></td>
                        <td><?php echo $cliente?></td>
                        <td><?php echo $cantidad?></td>
                        <td><?php echo $ubicacion?></td>
                        <td><?php echo $qr_code?></td>
                        <td>
                        <?php echo "<img src='" . $registro['qr_code'] . "'>"; ?> <br>
                        <a href="<?php echo $registro['qr_code']; ?>"><?php echo $registro['numdepieza']; ?></a>
                        </td>
                        <td>
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