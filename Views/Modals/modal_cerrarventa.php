<div class="modal modalAnimate fade" tabindex="-1" id="modal_cerrarventa">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

          <h5 class="font-weight-light text-primary" id="titleModal"></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="formCategoria" name="formCategoria">

      <div class="row">
          <input type="hidden" class="form-control" id="id_categoria" name="id_categoria">
          <div class="col-sm-6">          
            <div class="form-group">
                <label>Cliente</label>
                  <select class="form-control" style="width: 100%;" name="cliente" id="cliente">
                    <option value="1">Cliente Mostrador</option>
                    <option value="2">Otro cliente</option>
                  </select>
            </div>     
          </div>
          <div class="col-sm-4">          
            <div class="form-group">
                <label>Forma de Pago</label>
                  <select class="form-control" style="width: 100%;" name="pago" id="pago">
                    <option value="1">Efectivo</option>
                    <option value="2">Tarjeta Credito</option>
                    <option value="2">Tarjeta  Débito</option>
                  </select>
            </div>      
          </div>

          <div class="col-sm-2">
            <div class="form-group">
                  <label>Descuento %</label>
                  <input type="number" class="form-control" id="descuento" name="descuento" value="0.00">
            </div>
        </div>
      </div>
      <!-- row -->

      <div class="row tipo_pago"> <!-- MOSTRAR SI SELECT FORMA DE PAGO -->
          <input type="hidden" class="form-control" id="id_categoria" name="id_categoria">
          <div class="col-sm-4">          
            <div class="form-group">
                <label>TARJETA</label>
                <input type="text" class="form-control" id="tipo_cliente" name="tipo_cliente" readonly>
            </div>     
          </div>
          <div class="col-sm-4">          
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" class="form-control" id="cliente_descripcion" name="cliente_descripcion" readonly>
            </div>      
          </div>
      </div>
      <!-- row -->

      <div class="row cliente"> <!-- MOSTRAR SI SELECT CLIENTE -->
          <input type="hidden" class="form-control" id="id_categoria" name="id_categoria">
          <div class="col-sm-4">          
            <div class="form-group">
                <label>Tipo Cliente</label>
                <input type="text" class="form-control" id="tipo_cliente" name="tipo_cliente" readonly>
            </div>     
          </div>
          <div class="col-sm-4">          
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" class="form-control" id="cliente_descripcion" name="cliente_descripcion" readonly>
            </div>      
          </div>

          <div class="col-sm-2">
            <div class="form-group">
                  <label>Descuento %</label>
                  <input type="number" class="form-control" id="descuento" name="descuento" value="0.00">
            </div>
        </div>
      </div>
      <!-- row -->

      <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                  <label>TOTAL FINAL</label>
                  <input type="text" class="form-control" id="total_final" name="total_final" readonly>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                  <label>DESCUENTO</label>
                  <input type="text" class="form-control" id="total_descuento" name="total_descuento" readonly value="0,00">
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                  <label>PAGO EFECT.</label>
                  <input type="number" class="form-control" id="total_descuento" name="total_descuento">
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                  <label>VUELTO</label>
                  <input type="number" class="form-control" id="total_descuento" name="total_descuento">
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