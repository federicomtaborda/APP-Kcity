
<div class="modal modalAnimate fade" tabindex="-1" id="modal_edit_proveedor">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

          <h5 class="font-weight-light text-primary" id="titleModal"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <form id="formProveedor" name="formProveedor">

      <div class="row">
          <input type="hidden" class="form-control" id="id_proveedor" name="id_proveedor">
          <div class="col-sm-12">          
            <div class="form-group">
                <label>Nombre del Proveedor</label>
                <input type="text" class="form-control" id="proveedor" name="proveedor">
              </div>      
          </div>
          <div class="col-sm-12">          
            <div class="form-group">
                <label>Descripción</label>
                <textarea type="text" class="form-control" id="descripcion" name="descripcion" row="2"></textarea>
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
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"> 
          <i class="far fa-window-close"></i> 
            Cerrar
        </button>

        <button type="submit" class="btn btn-primary btn-sm"> 
        <i class="far fa-save"></i><span id="btnText"> Guardar</span> 
            
        </button>
      </div>

    </form>
      
    </div>
  </div>
</div>