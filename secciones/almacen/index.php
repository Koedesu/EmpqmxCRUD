<?php

include("../../db.php");

//Envio de parametros a traves de la URL en el metodo GET
//METODO DELETE
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conn -> prepare("DELETE FROM tbl_almacen WHERE id=:id");
    $sentencia -> bindParam(":id",$txtID);
    $sentencia -> execute();
    $mensaje = "Registro elminado";
    Header("Location:index.php?mensaje=".$mensaje);

}

//METODO GET PARA MOSTRAR INFIORMACION
$sentencia = $conn -> prepare("SELECT * FROM `tbl_almacen`");
$sentencia -> execute();
$lista_tbl_almacen = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

?>

<?php
include("../../templates/header.php");
?>

<?php
    if(isset($_GET['mensaje'] )) {?>
<script>
    Swal.fire({
        icon:"success",
        title:"<?php echo $_GET['mensaje']; ?>"
    });
</script>
<?php } ?>

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
            <table class="table" id="tabla_id">
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

                <?php foreach ($lista_tbl_almacen as $registro) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id']; ?></td>
                        <td><?php echo $registro['numdepieza']; ?></td>
                        <td><?php echo $registro['cliente']; ?></td>
                        <td><?php echo $registro['cantidad']; ?></td>
                        <td><?php echo $registro['ubicacion']; ?></td>
                        <td>
                        <?php echo "<img src='" . $registro['qr_code'] . "'>"; ?> <br>
                        <a target="_blank" href="<?php echo $registro['qr_code']; ?>"><?php echo $registro['numdepieza']; ?></a>
                        </td>
                        <td>
                            | <a class="btn btn-info" href="edit.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a> |
                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a> |
                        </td>
                    </tr>
                    <?php } ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    function borrar(id){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
        }).then((result) => {
  /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            window.location="index.php?txtID="+id;
            }
        })
    }

</script>

<?php
include("../../templates/footer.php");

?>