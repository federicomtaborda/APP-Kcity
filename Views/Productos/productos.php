<?php 
  headerAdmin($data); 
  getModal('modal_edit_prod',$data);
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
              <li class="breadcrumb-item"> <a href=<?php echo base_url() ?>><?= $data['page_home'] ?></a></li>
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

	  	<div class="row">
          <div class="col-12">

			<div class="card">
					<div class="card-header">
						<h3 class="card-title">Tabla de Productos en Sistema</h3>
					</div>
          
					<!-- /.card-header -->
					<div class="card-body">
            
						<table id="tableProductos" class="table table-hover table-bordered" style="font-size:14px;">
						<thead>
						<tr>
              <th></th>
              <th>img</th>
							<th>codigo</th>
							<th>producto</th>
              <th>costo</th>
              <th>precio</th>
              <th>stock</th>
              <th>stockmin</th>
              <th>categoria</th>
              <th>proveedor</th>
              <th>estado</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					</div>
					<!-- /.card -->


			
				
				
			</div><!-- /.container-fluid -->

		  </div>
		</div>  	
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

  <!-- Page specific script -->
<script>

</script>

  </div>
  <!-- ./wrapper -->
  <?php footerAdmin($data); ?>