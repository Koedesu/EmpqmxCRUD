<?php
include("../../db.php");

$sentencia = $conn -> prepare("SELECT * FROM `tbl_roles`");
$sentencia -> execute();
$lista_tbl_roles = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['txtID'])){

  $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";

  $sentencia = $conn -> prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
  $sentencia -> bindParam(":id",$txtID);
  $sentencia -> execute();

  $registro = $sentencia -> fetch(PDO::FETCH_LAZY);

  $usuario = $registro["usuario"];
  $snombre = $registro["snombre"];
  $papellido = $registro["papellido"];
  $sapellido = $registro["sapellido"];
  $rol_id = $registro["rol_id"];
  //$qr_code = $registro["qr_code"];

}
if($_POST){
  //Recolectamos los datos del metodo POST
  $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
  $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
  $snombre=(isset($_POST["snombre"])?$_POST["snombre"]:"");
  $papellido=(isset($_POST["papellido"])?$_POST["papellido"]:"");
  $sapellido=(isset($_POST["sapellido"])?$_POST["sapellido"]:"");
  $rol_id=(isset($_POST["rol_id"])?$_POST["rol_id"]:"");
    

  //Preparar insercion de los datos
  $sentencia = $conn -> prepare("UPDATE tbl_usuarios SET usuario= :usuario,
  snombre= :snombre,
  papellido= :papellido,
  sapellido= :sapellido,
  rol_id=:rol_id
  WHERE id=:id");
  //Asignando los valores que vienen del moetodo POST
  $sentencia -> bindParam(":usuario",$usuario);
  $sentencia -> bindParam(":snombre",$snombre);
  $sentencia -> bindParam(":papellido",$papellido);
  $sentencia -> bindParam(":sapellido",$sapellido);
  $sentencia -> bindParam(":rol_id",$rol_id);
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
        <h4>Editar Usuario</h4>
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
      <label for="usuario" class="form-label"><strong>Usuario:</strong></label>
      <input type="text"
        value= "<?php echo $usuario; ?>"
        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario">
    </div>

    <div class="mb-3">
      <label for="snombre" class="form-label"><strong>Nombre:</strong></label>
      <input type="text"
        value= "<?php echo $snombre; ?>"
        class="form-control" name="snombre" id="snombre" aria-describedby="helpId" placeholder="Segundo nombre">
    </div>

    <div class="mb-3">
      <label for="papellido" class="form-label"><strong>Apellido Paterno:</strong></label>
      <input type="text"
        value= "<?php echo $papellido; ?>"
        class="form-control" name="papellido" id="papellido" aria-describedby="helpId" placeholder="Apellido Paterno">
    </div>

    <div class="mb-3">
      <label for="sapellido" class="form-label"><strong>Apellido Materno:</strong></label>
      <input type="text"
        value= "<?php echo $sapellido; ?>"
        class="form-control" name="sapellido" id="sapellido" aria-describedby="helpId" placeholder="Apellido Materno">
    </div>

    <div class="m-3">
      <label for="rol_rol" class="form-label">Rol:</label>
      "<?php echo $rol_id; ?>"
      <select name="rol_id" id="rol_id" class="form-select form-select-sm">
        <?php foreach ($lista_tbl_roles as $registro) { ?>

          <option <?php echo ($rol_id== $registro['id'])?"selected":"";?> value="<?php echo $registro['id'] ?>">
          <?php echo $registro['roles'] ?>
          </option>
          <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="rol_id" class="form-label"><strong>Rol:</strong></label>

      <select class='form-select form-select-sm' name="rol_id" id="rol_id">
      <?php foreach ($lista_tbl_roles as $registro) { ?>
        <option value="<?php echo $registro['id'] ?>"> 
        <?php echo $registro['roles'] ?> 
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