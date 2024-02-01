<?php
include("../../db.php");

if(isset($_GET['txtID'])){

  $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

  $sentencia = $conn -> prepare("SELECT * FROM tbl_racks WHERE id=:id");
  $sentencia -> bindParam(":id",$txtID);
  $sentencia -> execute();
  $registro = $sentencia -> fetch(PDO::FETCH_LAZY);

  $rack = $registro["rack"];

  $sentencia = $conn -> prepare("SELECT * FROM `tbl_racks`");
  $sentencia -> execute();
  $lista_tbl_racks = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

}
if($_POST){
  //Recolectamos los datos del metodo POST
  $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
  $rack=(isset($_POST["rack"])?$_POST["rack"]:"");

  //Preparar insercion de los datos
  $sentencia = $conn -> prepare("UPDATE tbl_racks SET rack= :rack
  WHERE id=:id");
  //Asignando los valores que vienen del moetodo POST
  $sentencia -> bindParam(":rack",$rack);
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
    <h4>Actualizar: <?php echo $rack; ?></h4>
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
      <label for="rack" class="form-label"><strong>Nombre Rack:</strong></label>
      <input type="text"
        value= "<?php echo $rack; ?>"
        class="form-control" name="rack" id="rack" aria-describedby="helpId" placeholder="# de Pieza:">
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