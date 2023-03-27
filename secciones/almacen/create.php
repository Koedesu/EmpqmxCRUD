<?php   
include("../../db.php");

if($_POST){
    //Recolectamos los datos del metodo POST
    $numdepieza=(isset($_POST["numdepieza"])?$_POST["numdepieza"]:"");
    $cliente=(isset($_POST["cliente"])?$_POST["cliente"]:"");
    $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");
    $ubicacion=(isset($_POST["ubicacion"])?$_POST["ubicacion"]:"");

      $qr_data = "# de Pieza: $numdepieza // Cliente: $cliente // Cantidad: $cantidad // Ubicacion: $ubicacion";
    $qr_code = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . urlencode($qr_data);

    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO tbl_almacen(id,numdepieza,cliente,cantidad,ubicacion,qr_code)
        VALUES (null, :numdepieza, :cliente, :cantidad, :ubicacion, :qr_code)");

    

    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":numdepieza",$numdepieza);
    $sentencia -> bindParam(":cliente",$cliente);
    $sentencia -> bindParam(":cantidad",$cantidad);
    $sentencia -> bindParam(":ubicacion",$ubicacion);
    $sentencia -> bindParam(":qr_code",$qr_code);
    $sentencia -> execute();
    $mensaje = "Registro Añadido";

    Header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php 
include("../../templates/header.php");
?>

<br>

<div class="card">
    <div class="card-header">
        <h4># de Pieza</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="numdepieza" class="form-label"># de Pieza:</label>
      <input type="text"
        class="form-control" name="numdepieza" id="numdepieza" aria-describedby="helpId" placeholder="# de Pieza:">
    </div>

    <div class="mb-3">
      <label for="cliente" class="form-label">Cliente:</label>
      <input type="text"
        class="form-control" name="cliente" id="cliente " aria-describedby="helpId" placeholder="Cliente:">
    </div>

    <div class="mb-3">
      <label for="cantidad" class="form-label">Cantidad:</label>
      <input type="text"
        class="form-control" name="cantidad" id="cantidad " aria-describedby="helpId" placeholder="Cantidad:">
    </div>

    <div class="mb-3">
      <label for="ubicacion" class="form-label">Ubicación:</label>
      <input type="text"
        class="form-control" name="ubicacion" id="ubicacion " aria-describedby="helpId" placeholder="Ubicacion:">
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