<head>
<link rel="stylesheet" href=style.css>
</head>
</main>

  <footer class="footer-container">
    <!-- place footer here -->
    Created by: Marco Aurelio Valadez Guzman
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
<script>


  $(document).ready(function (){
    $("#tabla_id").DataTable({
      "pageLength":25,
      lengthMenu:[
        [10,25,50,100],
        [10,25,50,100]
      ],
      "language":{
        "url":"https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
      }
    })
  
  });
  </script>

</body>

</html>