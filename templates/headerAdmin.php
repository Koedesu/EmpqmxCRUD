<?php
session_start();
$url_base="http://localhost/EmpqmxCRUD/";
//$url_base="http://reyempaquemex.infinityfreeapp.com/";
// if ($_SESSION['rol_id'] != 1) {
//   // Si el usuario no tiene el rol adecuado, redirigir a otra página
//   header('Location:'.$url_base);
//   exit;
// }
?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <header>
    <!-- place navbar here -->
    <nav class="navbar fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold fs-4" style="color:#F53C14   " href="<?php echo $url_base;?>">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYCVAcaWeQeMKXPyOO6FaX6OXKEMbQzD-wMaZRrrE&s" alt="" width="40" height="40" class="d-inline-block align-text-center">
            Empaquemex</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <img src="https://cdn-icons-png.flaticon.com/512/3896/3896341.png" style="float:left; margin-right:10px" alt="" width="40" height="40" >
                    <h2 class="offcanvas-title text-info" href="<?php echo $url_base;?>" style="text-transform:capitalize; text-align:center" id="offcanvasNavbarLabel"><?php echo $_SESSION['usuario'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" style="color:#FFFFFF" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link fs-5" style="text-align:left" aria-current="page" href="<?php echo $url_base;?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link fs-5" style="text-align:left" href="<?php echo $url_base;?>secciones/almacen/">Almacén</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link fs-5" style="text-align:left" href="<?php echo $url_base;?>secciones/roles/">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" style="text-align:left" href="<?php echo $url_base;?>secciones/admin/">Usuarios</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link fs-5" style="text-align:left" href="<?php echo $url_base;?>secciones/ventas/">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger fs-5" style="text-align:center" href="<?php echo $url_base;?>cerrar.php">Cerrar Sesión</a>
                        </li>
                </div>
            </div>
        </div>
    </nav>
  </header>

  <main class="container">