<?php
include("../../db.php");

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
  $precio = $registro["precio"];

}
if($_POST){
  //Recolectamos los datos del metodo POST
  $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
  $numdepieza=(isset($_POST["numdepieza"])?$_POST["numdepieza"]:"");
  $cliente=(isset($_POST["cliente"])?$_POST["cliente"]:"");
  $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");
  $ubicacion=(isset($_POST["ubicacion"])?$_POST["ubicacion"]:"");
  $precio=(isset($_POST["precio"])?$_POST["precio"]:"");
    

  //Preparar insercion de los datos
  $sentencia = $conn -> prepare("UPDATE tbl_almacen SET numdepieza= :numdepieza,
  cliente= :cliente,
  cantidad= :cantidad,
  ubicacion= :ubicacion,
  precio=:precio
  WHERE id=:id");
  //Asignando los valores que vienen del moetodo POST
  $sentencia -> bindParam(":numdepieza",$numdepieza);
  $sentencia -> bindParam(":cliente",$cliente);
  $sentencia -> bindParam(":cantidad",$cantidad);
  $sentencia -> bindParam(":ubicacion",$ubicacion);
  $sentencia -> bindParam(":precio",$precio);
  $sentencia -> bindParam (":id",$txtID);
  $sentencia -> execute();
  $mensaje = "Registro Actualizado";

  Header("Location:index.php?mensaje=".$mensaje);
}
?>
<?php 
include("../../templates/header.php");
?>
<br><br><br><br><br>
<div class="card">
    <div class="card-header">
        <h4>Actualizar: <?php echo $numdepieza; ?></h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="txtID" class="form-label"><strong>ID:</strong></label>
      <input type="text"
        value= "<?php echo $txtID; ?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

    <div class="mb-3">
      <label for="numdepieza" class="form-label"><strong># de Pieza:</strong></label>
      <input type="text"
        value= "<?php echo $numdepieza; ?>"
        class="form-control" readonly name="numdepieza" name="numdepieza" id="numdepieza" aria-describedby="helpId" placeholder="# de Pieza:">
    </div>

    <div class="mb-3">
      <label for="cliente" class="form-label"><strong>Cliente:</strong></label>
      <input type="text"
        value= "<?php echo $cliente; ?>"
        class="form-control" readonly name="cliente" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Cliente:">
    </div>

    <div class="mb-3">
      <label for="cantidad" class="form-label"><strong>Cantidad:</strong></label>
      <input type="text"
        value= "<?php echo $cantidad; ?>"
        class="form-control" readonly name="cantidad" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Cantidad:">
    </div>

    <div class="mb-3">
      <label for="precio" class="form-label"><strong>Precio:</strong></label>
      <input type="text"
        value= "<?php echo $precio; ?>"
        class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="Precio:">
    </div>

    <button type="submit" class="btn btn-success">Actualizar</button> 
    <a name="btn-cancelar" id="btn-cancelar" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

    </form>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include("../../templates/footer.php");

?>