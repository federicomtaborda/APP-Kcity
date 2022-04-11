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

      <?php $producto = $data['producto']; ?>
      
      <div class="row">
        <div class="col-12">
          <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title"><?php echo $data['tipo_name'] ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                <!-- Inicio form -->
                <form id="formInsertProducto" name="formInsertProducto">
                <input type="hidden" value="<?php echo $producto['id'] ?>" name="idproducto" id="idproducto">
                  <div class="row">
                    <div class="col-md-4 col-sm-6">
                      <div class="form-group">
                          <input type="file" class="custom-file-input" id="imagen" name="imagen">
                          <label class="custom-file-label" for="customFile"><i class="far fa-image"></i></label>
                      </div>   
                    </div>

                  </div>   

                    <div class="row">
                      <div class="col-md-6">
                      
                        <div class="form-group">
                          <label>Codigo identificatorio <i class="fas fa-barcode"></i></label>
                          <input type="text" class="form-control" placeholder="ingrese codigo del producto.." 
                            value="<?php echo $producto['codigo'];?>" id="codigo" name="codigo">
                        </div>
                        
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nombre del Producto</label>
                          <input type="text" class="form-control" placeholder="ingrese nombre del producto.."
                          value="<?php echo $producto['producto']; ?>" id="producto" name="producto">
                      </div>  

                    </div>

                    </div>  
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Descripcion del Producto</label>
                          <textarea class="form-control" rows="3" placeholder="ingrese Descripción.."
                          id="descripcion" name="descripcion"><?php echo $producto['descripcion']; ?></textarea>
                        </div>  
                      </div>
                    </div> 

                    <div class="row">

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Costo</label>
                          <input class="form-control" placeholder="ingrese un costo.." value="<?php echo $producto['costo']; ?>" 
                            id="costo" name="costo">
                        </div>  
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Precio</label>
                          <input class="form-control" placeholder="ingrese un precio.." value="<?php echo $producto['precio']; ?>"
                          id="precio" name="precio">
                        </div>  
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="text-success">Stock</label>
                          <input class="form-control" placeholder="ingrese un stock.." value="<?php echo $producto['stock']; ?>"
                          id="stock" name="stock">
                        </div>  
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label class="text-danger">Stock Minimo</label>
                          <input class="form-control" placeholder="ingrese un stock minimo.." value="<?php echo $producto['stock_min']; ?>"
                          id="stock_minimo" name="stock_minimo">
                        </div>  
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Categoria del Producto</label>
                            <select class="form-control" style="width: 100%;" 
                              id="categorias" name="categorias">
                              <option value="1">no asignado</option>
                            </select>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Proveedor del Producto</label>
                            <select class="form-control" style="width: 100%;" 
                              id="proveedores" name="proveedores">
                              <option value="1">no asignado</option>
                            </select>
                        </div>
                      </div>

                    </div>  
                    <div class="row">

                      <div class="col-sm-12 col-md-3" >
                        <div class="form-group">
                          <label>Producto Creado</label>
                          <input type="text" class="form-control"  value="<?php echo $producto['fecha_creacion']; ?>" disabled>
                        </div>  
                      </div>  

                      <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                          <label>Estado</label>
                          <select class="form-control" id="estado" name="estado">
                            <?php 
                            if($producto['estado'] == 1) { ?> 

                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option> 

                          <?php }else{ ?>

                            <option value="2">Inactivo</option>
                            <option value="1">Activo</option>

                            <?php } ?>
                              
                          </select>
                        </div>  
                      </div> 

                    </div>

                    <div class="row justify-content-end">
                          <div class="col-sm-2 pb-1">
                            <a href="<?php echo base_url() ?>productos" class="btn btn-block btn-secondary btn-sm">
                              <i class="far fa-window-close"></i> Cancelar
                            </a>
                          </div>
                          <div class="col-sm-2 pb-1">
                            <button type="submit" class="btn btn-block btn-primary btn-sm">
                              <i class="far fa-save"></i> Guandar
                            </button>
                          </div>
                    </div>

                    <!-- Fim form -->
                    </form>

                    </div>  

                </div>

                
                <!-- /.card-body -->
          </div>
      </div>            
        
        
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