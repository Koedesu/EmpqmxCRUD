<?php 

include("templates/header.php");

?>
<br>
  <div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Bienvenido/a <?php echo $_SESSION['usuario'];?>! </h1>
      <p class="col-md-8 fs-4">Sistema de control de inventarios para almacen y ventas de la empresa Empaquemex S.A. de C.V. </p>
      <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
    </div>
<?php 

include("templates/footer.php");

?>