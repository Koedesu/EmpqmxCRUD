<?php

//session_start();
$url_base="http://localhost/EmpqmxCRUD/";


include("../../db.php");

//Envio de parametros a traves de la URL en el metodo GET
//METODO DELETE
if(isset($_GET['txtID'])){

    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conn -> prepare("DELETE FROM tbl_roles WHERE id=:id");
    $sentencia -> bindParam(":id",$txtID);
    $sentencia -> execute();
    $mensaje = "Registro eliminado";
    Header("Location:index.php?mensaje=".$mensaje);

}

//METODO GET PARA MOSTRAR INFIORMACION

$sentencia = $conn -> prepare("SELECT * FROM `tbl_roles`");
$sentencia -> execute();
$lista_tbl_roles = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

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

<br><br><br><br><br>
<h4>Roles</h4>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" 
        href="create.php" role="button">
        Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table  class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($lista_tbl_roles as $registro) { ?>
                    <tr class="">
                        <td><?php echo $registro['id']; ?></td>
                        <td style="text-transform: capitalize" scope="row">
                            <?php echo $registro['roles']; ?>
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