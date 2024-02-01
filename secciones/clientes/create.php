<?php   
include("../../db.php");

if($_POST){
    //Recolectamos los datos del metodo POST
    $nombrecliente=(isset($_POST["nombrecliente"])?$_POST["nombrecliente"]:"");

    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO tbl_clientes(id,nombrecliente)
        VALUES (null, :nombrecliente)");

    

    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":nombrecliente",$nombrecliente);
    $sentencia -> execute();
    $mensaje = "Registro Añadido";

    Header("Location:index.php?mensaje=".$mensaje);
}

$sentencia = $conn -> prepare("SELECT * FROM `tbl_clientes`");
$sentencia -> execute();
$lista_tbl_clientes = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

?>

<?php 
include("../../templates/header.php");
?>

<br><br><br><br><br>
<div class="card">
    <div class="card-header">
        <h4>Agregar Nuevo Cliente</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="nombrecliente" class="form-label"><strong>Cliente:</strong></label>
      <input type="text"
        class="form-control" name="nombrecliente" id="nombrecliente" aria-describedby="helpId" placeholder="Cliente:">
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