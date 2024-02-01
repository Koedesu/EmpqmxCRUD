<?php   
include("../../db.php");

if($_POST){
    //Recolectamos los datos del metodo POST
    $rack=(isset($_POST["rack"])?$_POST["rack"]:"");

    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO tbl_racks(id,rack)
        VALUES (null, :rack)");

    

    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":rack",$rack);
    $sentencia -> execute();
    $mensaje = "Registro Añadido";

    Header("Location:index.php?mensaje=".$mensaje);
}

$sentencia = $conn -> prepare("SELECT * FROM `tbl_racks`");
$sentencia -> execute();
$lista_tbl_racks = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

?>

<?php 
include("../../templates/header.php");
?>

<br><br><br><br><br>
<div class="card">
    <div class="card-header">
        <h4>Agregar Nuevo Rack</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="rack" class="form-label"><strong>Rack:</strong></label>
      <input type="text"
        class="form-control" name="rack" id="rack" aria-describedby="helpId" placeholder="Rack:">
    </div>

    <button type="submit" class="btn btn-success"><strong>Agregar</strong></button> 
    <a name="btn-cancelar" id="btn-cancelar" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

    </form>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php  
include("../../templates/footer.php");
?>