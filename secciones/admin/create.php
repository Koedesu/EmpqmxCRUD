<?php   
include("../../db.php");

if($_POST){
  
    //Recolectamos los datos del metodo POST
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $contra=(isset($_POST["contra"])?$_POST["contra"]:"");
    $snombre=(isset($_POST["snombre"])?$_POST["snombre"]:"");
    $papellido=(isset($_POST["papellido"])?$_POST["papellido"]:"");
    $sapellido=(isset($_POST["sapellido"])?$_POST["sapellido"]:"");
    $rol_id=(isset($_POST["rol_id"])?$_POST["rol_id"]:"");

    //Preparar insercion de los datos
    $sentencia = $conn -> prepare("INSERT INTO 
    `tbl_usuarios`(`id`,`usuario`,`contra`,`snombre`,`papellido`,`sapellido`, `rol_id`)
        VALUES (null, :usuario, :contra, :snombre, :papellido, :sapellido, :rol_id);");

    

    //Asignando los valores que vienen del moetodo POST
    $sentencia -> bindParam(":usuario",$usuario);
    $sentencia -> bindParam(":contra",$contra);
    $sentencia -> bindParam(":snombre",$snombre);
    $sentencia -> bindParam(":papellido",$papellido);
    $sentencia -> bindParam(":sapellido",$sapellido);
    $sentencia -> bindParam(":rol_id",$rol_id);
    $sentencia -> execute();
    $mensaje = "Registro Añadido";

    Header("Location:index.php?mensaje=".$mensaje);
}

$sentencia = $conn -> prepare("SELECT * FROM `tbl_roles`");
$sentencia -> execute();
$lista_tbl_roles = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

?>

<?php 
include("../../templates/header.php");
?>

<br><br><br><br>

<div class="card">
    <div class="card-header">
        <h4>Agregar Usuario</h4>
    </div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="usuario" class="form-label"><strong>Usuario:</strong></label>
      <input type="text"
        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario">
    </div>
    
    <div class="mb-3">
      <label for="contra" class="form-label"><strong>Contraseña:</strong></label>
      <input type="password"
        class="form-control" name="contra" id="contra" aria-describedby="helpId" placeholder="Contraseña">
    </div>
    
    <div class="mb-3">
      <label for="snombre" class="form-label"><strong>Segundo Nombre:</strong></label>
      <input type="text"
        class="form-control" name="snombre" id="snombre" aria-describedby="helpId" placeholder="Segundo Nombre">
    </div>
    
    <div class="mb-3">
      <label for="papellido" class="form-label"><strong>Primer Apellido:</strong></label>
      <input type="text"
        class="form-control" name="papellido" id="papellido" aria-describedby="helpId" placeholder="Primer Apellido">
    </div>
    
    <div class="mb-3">
      <label for="sapellido" class="form-label"><strong>Segundo Apellido:</strong></label>
      <input type="text"
        class="form-control" name="sapellido" id="sapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
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

    <button type="submit" class="btn btn-success">Agregar</button> 
    <a name="btn-cancelar" id="btn-cancelar" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

    </form>
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include("../../templates/footer.php");

?>