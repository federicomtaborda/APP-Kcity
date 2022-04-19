<?php 

headerAdmin($data); 

getModal('modal_cerrarventa',$data);

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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row mt-4">
          <!-- left column -->
          <div class="col-md-12 col-ms-12">
            <!-- general form elements -->
            <div class="card">
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="row ml-1">

                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control" id="codigo" name="codigo" 
                        placeholder="ingrese código / producto" autofocus>
                      </div>
                    </div>

                    <div class="col-md-7 text-right mr-1">
                      <h3 id="total_suma" class="text-danger">$0.00</h3> <span id="total_cantidad"></span>
                    </div>  

                  </div>
                  <!-- /.row -->

                  <div class="row ml-1">
                    <div class="col-md-2 mt-1">
                        <button type="button" class="btn btn-block btn-secondary btn-sm">
                          <i class="fas fa-list-ol"></i>
                          Presupuesto
                        </button>
                      </div>

                      <div class="col-md-2 mt-1">
                        <button type="button" class="btn btn-block btn-secondary btn-sm">
                        <i class="fas fa-users"></i> Clientes
                        </button>
                      </div>

                      <div class="col-md-2 mt-1">
                        <button type="button" class="btn btn-block btn-outline-success btn-sm" onclick ="cerrar_venta()">
                          <i class="fas fa-money-bill-alt"></i>
                          Cerrar Venta
                        </button>
                      </div>

                      <div class="col-md-2 mt-1">
                        <button type="button" class="btn btn-block btn-outline-danger btn-sm" id="borrar_venta" onclick ="borar_carga()">
                          <i class="fas fa-trash-alt"></i>
                          Borrar Venta
                        </button>
                      </div>

                  </div>
                     
                  <div class="col-md-12 my-3">
                        <table class="table table-bordered" id="table_ventas">
                          <thead>
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Producto</th>
                              <th style="width: 100px">Cantidad</th>
                              <th style="width: 62px">Precio</th>
                              <th style="width: 62px">Sub_total</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table> 
                  </div>
                  
                </div>
                <!-- /.row -->
                    
                </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->

    
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