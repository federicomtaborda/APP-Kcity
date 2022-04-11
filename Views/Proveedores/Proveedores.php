<?php headerAdmin($data); 
      getModal('modal_edit_proveedor',$data);
?>

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



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $data['page_name'] ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=<?php BASE_URL ?>><?= $data['page_home'] ?></a></li>
              <li class="breadcrumb-item active"><?= $data['page_name'] ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Proveedores de Productos</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">

            <!-- /.card -->
            <div class="card">
            <div class="my-2 mx-3">
                <button class="btn btn-secondary btn-sm" type="button" onclick="openModal();" >
                    <i class="fas fa-plus-circle"></i> Proveedor
                </button>
            </div>

              <!-- /.card-header -->
              <div class="card-body">
              <table id="tableProveedores" class="table table-bordered table-striped" style="font-size:13px;">
                  <thead>
                  <tr>
                    <th>Imagen</th>
                    <th>Proveedor</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th></th> 
                  </tr>
                  </thead>

                  <tbody> </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>

        </div>
        <!-- /.card -->
    </section>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   <!-- Main Sidebar Container -->
   <?php $pie_footer = "Views/footer/pie_footer.php";
          require_once ($pie_footer); 
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  </div>
  <!-- ./wrapper -->
  <?php footerAdmin($data); ?>