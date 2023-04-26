<?php 
//session_start();
include("templates/header.php");

?>
<br><br><br><br><br>
  <div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Bienvenido/a <?php echo $_SESSION['usuario'];?>! </h1>
      <p class="col-md-8 fs-4">Sistema de control de inventarios para los departamentos de Almacen y Ventas de la empresa Empaquemex S.A. de C.V. </p>
      <img src="https://boxlandsa.com/wp-content/uploads/2016/09/tarima-T.png" width="500" height=333" alt="">
    </div>
    </div>
<?php 

include("templates/footer.php");

?>