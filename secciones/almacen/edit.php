<?php
include("../../db.php");

if(isset($_GET['txtID'])){

  $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

  $sentencia = $conn -> prepare("SELECT * FROM tbl_almacen WHERE id=:id");
  $sentencia -> bindParam(":id",$txtID);
  $sentencia -> execute();
  $registro = $sentencia -> fetch(PDO::FETCH_LAZY);

  $numdepieza = $registro["numdepieza"];
  $idcliente = $registro["idcliente"];
  $cantidad = $registro["cantidad"];
  $ubicacion = $registro["ubicacion"];
  //$qr_code = $registro["qr_code"];

  $sentencia = $conn -> prepare("SELECT * FROM `tbl_clientes`");
  $sentencia -> execute();
  $lista_tbl_clientes = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

  $sentencia = $conn -> prepare("SELECT * FROM `tbl_racks`");
  $sentencia -> execute();
  $lista_tbl_racks = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

}
if($_POST){
  //Recolectamos los datos del metodo POST
  $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
  $numdepieza=(isset($_POST["numdepieza"])?$_POST["numdepieza"]:"");
  $idcliente=(isset($_POST["idcliente"])?$_POST["idcliente"]:"");
  $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");
  $ubicacion=(isset($_POST["ubicacion"])?$_POST["ubicacion"]:"");

  $qr_data = "# de Pieza: $numdepieza // Cliente: $idcliente // Cantidad: $cantidad // Rack: $ubicacion";
    $qr_code = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . urlencode($qr_data);

    

  //Preparar insercion de los datos
  $sentencia = $conn -> prepare("UPDATE tbl_almacen SET numdepieza= :numdepieza,
  idcliente= :idcliente,
  cantidad= :cantidad,
  ubicacion= :ubicacion,
  qr_code=:qr_code
  WHERE id=:id");
  //Asignando los valores que vienen del moetodo POST
  $sentencia -> bindParam(":numdepieza",$numdepieza);
  $sentencia -> bindParam(":idcliente",$idcliente);
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
        class="form-control" name="numdepieza" id="numdepieza" aria-describedby="helpId" placeholder="# de Pieza:">
    </div>

    <div class="mb-3">
      <label for="idcliente" class="form-label"><strong>Cliente:</strong></label>
      <?php echo $idcliente; ?>
      <select class="form-select form-select-sm" name="idcliente" id="idcliente">
        <?php foreach ($lista_tbl_clientes as $registro) { ?>

          <option <?php echo ($idcliente==$registro['id'])?"selected":"" ?> value="<?php echo $registro['id']?>"> 
          <?php echo $registro['nombrecliente'] ?>
        </option>
          <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="cantidad" class="form-label"><strong>Cantidad:</strong></label>
      <input type="text"
        value= "<?php echo $cantidad; ?>"
        class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Cantidad:">
    </div>

    <div class="mb-3">
      <label for="ubicacion" class="form-label"><strong>Rack:</strong></label>
      <?php echo $ubicacion; ?>
      <select class="form-select form-select-sm" name="ubicacion" id="ubicacion">
        <?php foreach ($lista_tbl_racks as $registro) { ?>

          <option <?php echo ($ubicacion==$registro['id'])?"selected":"" ?> value="<?php echo $registro['id']?>"> 
          <?php echo $registro['rack'] ?>
        </option>
          <?php } ?>
      </select>
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