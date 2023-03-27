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
  //$qr_code = $registro["qr_code"];

}
if($_POST){
  //Recolectamos los datos del metodo POST
  $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
  $numdepieza=(isset($_POST["numdepieza"])?$_POST["numdepieza"]:"");
  $cliente=(isset($_POST["cliente"])?$_POST["cliente"]:"");
  $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");
  $ubicacion=(isset($_POST["ubicacion"])?$_POST["ubicacion"]:"");

  $qr_data = "# de Pieza: $numdepieza // Cliente: $cliente // Cantidad: $cantidad // Ubicacion: $ubicacion";
    $qr_code = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . urlencode($qr_data);

    

  //Preparar insercion de los datos
  $sentencia = $conn -> prepare("UPDATE tbl_almacen SET numdepieza= :numdepieza,
  cliente= :cliente,
  cantidad= :cantidad,
  ubicacion= :ubicacion,
  qr_code=:qr_code
  WHERE id=:id");
  //Asignando los valores que vienen del moetodo POST
  $sentencia -> bindParam(":numdepieza",$numdepieza);
  $sentencia -> bindParam(":cliente",$cliente);
  $sentencia -> bindParam(":cantidad",$cantidad);
  $sentencia -> bindParam(":ubicacion",$ubicacion);
  $sentencia -> bindParam(":qr_code",$qr_code);
  $sentencia -> bindParam (":id",$txtID);
  $sentencia -> execute();
  $mensaje = "Registro Actualizado";

  Header("Location:index.php?mensaje=".$mensaje);
}
?>
<?php 
include("../../templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">
        <h4>Puestos</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="txtID" class="form-label">ID:</label>
      <input type="text"
        value= "<?php echo $txtID; ?>"
        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    </div>

    <div class="mb-3">
      <label for="numdepieza" class="form-label"># de Pieza:</label>
      <input type="text"
        value= "<?php echo $numdepieza; ?>"
        class="form-control" name="numdepieza" id="numdepieza" aria-describedby="helpId" placeholder="# de Pieza:">
    </div>

    <div class="mb-3">
      <label for="cliente" class="form-label">Cliente:</label>
      <input type="text"
        value= "<?php echo $cliente; ?>"
        class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Cliente:">
    </div>

    <div class="mb-3">
      <label for="cantidad" class="form-label">Cantidad:</label>
      <input type="text"
        value= "<?php echo $cantidad; ?>"
        class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Cantidad:">
    </div>

    <div class="mb-3">
      <label for="ubicacion" class="form-label">Ubicacion:</label>
      <input type="text"
        value= "<?php echo $ubicacion; ?>"
        class="form-control" name="ubicacion" id="ubicacion" aria-describedby="helpId" placeholder="Ubicación:">
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