<?php headerAdmin($data); ?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php $navBar = "Views/header/navbar.php";
          require_once ($navBar); 
    ?>

    <!-- Main Sidebar Container -->
  <?php $siderbar = "Views/header/siderbar.php";
          require_once ($siderbar); 
  ?>


<section class="content mt-5">
      <div class="error-page">
        <h2 class="headline text-danger">404</h2>

        <div class="error-content mt-5">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Pagina no encontrada</h3>

          <p>
            la pagina no fue encontrada.
            <a href=<?php base_url() ?>>volver al inicio.</a>
          </p>

        </div>
      </div>
      <!-- /.error-page -->

</section>

  </div>
  <!-- ./wrapper -->
  <?php footerAdmin($data); ?>