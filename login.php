<?php  
session_start();
$url_base="http://localhost/EmpqmxCRUD/";
//$url_base="http://reyempaquemex.infinityfreeapp.com/";
if($_POST){
    include("./db.php");

    //METODO GET PARA MOSTRAR INFIORMACION
    $sentencia = $conn -> prepare("SELECT *, count(*) as n_usuarios 
    FROM `tbl_usuarios`
    WHERE usuario=:usuario AND contra=:contra");

    

    $usuario = $_POST["usuario"];
    $contra = $_POST["contra"];

    $sentencia -> bindParam(":usuario",$usuario);
    $sentencia -> bindParam(":contra",$contra);
    $sentencia -> execute();
    
    $registro = $sentencia -> fetch(PDO::FETCH_LAZY);
    if($registro["n_usuarios"]>0){
      $_SESSION['usuario']=$registro["usuario"];
      $_SESSION['logueado']=true;
      Header("Location:index.php");
    } else{
      $mensaje = "Usuario o contraseña incorrectos";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>


<!-- <nav class="navbar navbar-expand-sm navbar-light bg-dark">
    <a class="navbar-brand" style="color:#F53C14; padding-left: 20px" href="<?php echo $url_base;?>">
      <img src="resources/logo.png" alt="" width="40" height="40" class="d-inline-block align-text-center">
      Empaquemex
    </a>
    <div class="collapse navbar-collapse"
    id="navbarNav">
    <ul class="navbar-nav">
    </ul>
    </div>
</nav> -->

<body>
  <header>
    <!-- place navbar here -->
    <nav class="navbar fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold fs-4" style="color:#F53C14   " href="<?php echo $url_base;?>">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYCVAcaWeQeMKXPyOO6FaX6OXKEMbQzD-wMaZRrrE&s" alt="" width="40" height="40" class="d-inline-block align-text-center">
            Empaquemex</a>
        </div>
    </nav>
  </header>
  <br><br><br><br>
  <main class="container">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4"> <br>
          <div class="card">
            <div class="card-header">
                <h4>
                  Inicia sesión
                </h4>
            </div>
            <div class="card-body">
              <img src="resources/banner-empaquemex.jpg" style="display:block; margin: 0 auto" alt="">
              <?php if(isset($mensaje)){ ?>

                <div class="alert alert-danger" role="alert">
                  <strong><?php echo $mensaje; ?></strong>
                </div>
              <?php } ?>
              
                <form action="" method="post">
                    <div class="mb-3">
                      <label for="usuario" class="form-label">Usuario:</label>
                      <input type="text"
                        class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Escribe tu usuario">
                    </div>
                    <div class="mb-3">
                      <label for="contra" class="form-label">Contraseña:</label>
                      <input type="password"
                        class="form-control" name="contra" id="contra" aria-describedby="helpId" placeholder="Escribe tu contraseña">
                    </div>

                    <button type="submitt" class="btn btn-primary">Login</button>

                </form>
            </div>
          </div>
        </div>
    </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>