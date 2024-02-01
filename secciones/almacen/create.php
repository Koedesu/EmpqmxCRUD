<?php   
include("../../db.php");

if($_POST){
    //Recolectamos los datos del metodo POST
    $numdepieza=(isset($_POST["numdepieza"])?$_POST["numdepieza"]:"");
    $idcliente=(isset($_POST["idcliente"])?$_POST["idcliente"]:"");
    $cantidad=(isset($_POST["cantidad"])?$_POST["cantidad"]:"");
    $ubicacion=(isset($_POST["ubicacion"])?$_POST["ubicacion"]:"");

      $qr_data = "# de Pieza: $numdepieza // Cliente: $idcliente // Cantidad: $cantidad // Rack: $ubicacion";
    $qr_code = 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . urlencode($qr_data);

    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO tbl_almacen(id,numdepieza,idcliente,cantidad,ubicacion,qr_code)
        VALUES (null, :numdepieza, :idcliente, :cantidad, :ubicacion, :qr_code)");

    

    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":numdepieza",$numdepieza);
    $sentencia -> bindParam(":idcliente",$idcliente);
    $sentencia -> bindParam(":cantidad",$cantidad);
    $sentencia -> bindParam(":ubicacion",$ubicacion);
    $sentencia -> bindParam(":qr_code",$qr_code);
    $sentencia -> execute();
    $mensaje = "Registro Añadido";

    Header("Location:index.php?mensaje=".$mensaje);
}

$sentencia=$conn->prepare("SELECT *,
(SELECT nombrecliente FROM tbl_clientes WHERE tbl_clientes.id = tbl_almacen.idcliente LIMIT 1) as cliente,
    (SELECT rack FROM tbl_racks WHERE tbl_racks.id = tbl_almacen.ubicacion LIMIT 1) as ubi
    FROM `tbl_almacen`
");
$sentencia->execute();
$lista_tbl_almacen=$sentencia->fetchALL(PDO::FETCH_ASSOC);

$sentencia = $conn -> prepare("SELECT * FROM `tbl_almacen`");
$sentencia -> execute();
$lista_tbl_almacen = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conn -> prepare("SELECT * FROM `tbl_racks`");
$sentencia -> execute();
$lista_tbl_racks = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

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
        <h4>Agregar Nuevo Registro</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="numdepieza" class="form-label"><strong># de Pieza:</strong></label>
      <input type="text"
        class="form-control" name="numdepieza" id="numdepieza" aria-describedby="helpId" placeholder="# de Pieza:">
    </div>

    <!-- <div class="mb-3">
      <label for="cliente" class="form-label"><strong>Cliente:</strong></label>
      <input type="text"
        class="form-control" name="cliente" id="cliente " aria-describedby="helpId" placeholder="Cliente:">
    </div> -->

    <div class="mb-3">
      <label for="idcliente" class="form-label"><strong>Cliente:</strong></label>
      <select class="form-select form-select-sm" name="idcliente" id="ida">
        <?php foreach ($lista_tbl_clientes as $registro) { ?>
          <option value="<?php echo $registro['id']?>"> 
          <?php echo $registro['nombrecliente'] ?></option>
          <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="cantidad" class="form-label"><strong>Cantidad:</strong></label>
      <input type="text"
        class="form-control" name="cantidad" id="cantidad " aria-describedby="helpId" placeholder="Cantidad:">
    </div> 

    <div class="mb-3">
      <label for="ubicacion" class="form-label"><strong>Rack:</strong></label>
      <select class="form-select form-select-sm" name="ubicacion" id="ubicacion">
        <?php foreach ($lista_tbl_racks as $registro) { ?>
          <option value="<?php echo $registro['id']?>"> 
          <?php echo $registro['rack'] ?></option>
          <?php } ?>
      </select>
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