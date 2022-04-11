
<div class="modal modalAnimate fade" tabindex="-1" id="modal_edit_prod">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

          <h5 class="font-weight-light text-primary" id="producto"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="formProductos" name="formProductos">

      <div class="row">
          <input type="hidden" class="form-control" id="id" name="id">
          <div class="col-sm-4">          
            <div class="form-group">
                <label>Precio</label>
                <input type="text" class="form-control" id="precio" name="precio">
              </div>      
          </div>
          <div class="col-sm-4">          
            <div class="form-group">
                <label>Stock</label>
                <input type="number" class="form-control" id="stock" name="stock">
              </div>      
          </div>
          <div class="col-sm-4">          
            <div class="form-group">
                <label class="text-danger">Stock Minimo</label>
                <input type="number" class="form-control" id="stock_minimo" name="stock_minimo">
              </div>      
          </div>
      </div>
      <!-- row -->

      <div class="row">
          <div class="col-sm-6">          
            <div class="form-group">
                <label>Proveedores</label>
                <select class="form-control" style="width: 100%;" name="proveedores" id="proveedores" required=""></select>
            </div>      
          </div>
          <div class="col-sm-6">          
            <div class="form-group">
                <label>Categorias</label>
                <select class="form-control" style="width: 100%;" name="categorias" id="categorias" required=""></select>
            </div>     
          </div>
      </div>
      <!-- row -->

      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
              <label>Estado</label>
                <select class="form-control" style="width: 100%;" name="estado" id="estado" required="">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
                </select>
          </div>
        </div>
      </div>
      <!-- row -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"> <i class="far fa-window-close"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm"> <i class="far fa-save"></i> Guardar</button>
      </div>

    </form>
      
    </div>
  </div>
</div>