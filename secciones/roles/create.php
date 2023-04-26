<?php   
include("../../db.php");

if($_POST){

  
    //Recolectamos los datos del metodo POST
    $roles=(isset($_POST["roles"])?$_POST["roles"]:"");

    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO tbl_roles(id,roles)
        VALUES (null, :roles)");

    

    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":roles",$roles);
    $sentencia -> execute();
    $mensaje = "Registro Añadido";

    Header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php 
include("../../templates/header.php");
?>

<br><br><br><br>

<div class="card">
    <div class="card-header">
        <h4>Agregar Rol</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="roles" class="form-label"><strong>Rol:</strong></label>
      <input type="text"
        class="form-control" name="roles" id="roles" aria-describedby="helpId" placeholder="Nuevo Rol">
    </div>

    <button type="submit" class="btn btn-success">Agregar</button> 
    <a name="btn-cancelar" id="btn-cancelar" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

    </form>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include("../../templates/footer.php");

?>