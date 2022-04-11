
//const base_url = "https://www.tandiltiendashop.com/APP-VENTAS/"; 
const base_url = "http://localhost/APP-TIENDA/"



/************************* LISTADO DE PRODUCTOS ******************************/
let tableProductos;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){

    fntCategorias();
    fntProveedores();

    tableProductos = $('#tableProductos').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"productos/getproductos",
        "dataSrc":""
    },
    "columns":[
        {"data":"options"},
        {"data":"imagen"},
        {"data":"codigo"},
        {"data":"producto"},
        {"data":"costo"},
        {"data":"precio"},
        {"data":"stock"},
        {"data":"stock_min"},
        {"data":"categoria"},
        {"data":"proveedor"},
        {"data":"estado"},

    ],
    "columnDefs": [
                    { 'className': "textcenter", "targets": [ 0 ] },
                    { 'className': "textright", "targets": [ 1 ] },
                    { 'className': "textcenter", "targets": [ 2 ] }
                  ],       
    'dom': 'lBfrtip',
    'buttons': [
        {
            
            "text": "<i class='fas fa-plus-circle'></i> Nuevo Producto",
            action: function() {

            window.location = 'pag_producto?new=producto';
            },
            "className": "btn btn-secondary btn-sm",
                
        }
        
    ],
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "bDestroy": true,
    "iDisplayLength": 25,
    "order":[[0,"desc"]]  
}); 

    //**** ACTUALIZA PRODUCTO ****/
    window.addEventListener('load', function() {
        if(document.querySelector("#formProductos")){
            let formProductos = document.querySelector("#formProductos");
            formProductos.onsubmit = function(e) {
                e.preventDefault();
                let intid = document.querySelector('#id').value;
                let strPrecio = document.querySelector('#precio').value;
                let intStock = document.querySelector('#stock').value;
                let intStock_min = document.querySelector('#stock_minimo').value;
                let intCategoria = document.querySelector('#categorias').value;
                let intProveedor = document.querySelector('#proveedores').value;
                let intEstado = document.querySelector('#estado').value;

                if(intid == '' || strPrecio == '' || intStock == '' || intStock_min == '')
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en Formulario',
                        text: 'Verifique los Datos!'
                      })
                return false;
                }

                let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url+'productos/setProducto'; 
                let formData = new FormData(formProductos);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
                    if(request.readyState == 4 && request.status == 200){
                        let objData = JSON.parse(request.responseText);
                        //console.log(objData);
                        if(objData.status)
                        { 

                            if(rowTable == ""){
                                tableProductos.api().ajax.reload();
                            }

                            Swal.fire({
                                    icon: 'success',
                                    title: 'Registro Guardado.',
                                    text: 'Correcto!',
                                    timer: 2200
                                  })


                            /*** CIERRE MODAL AUTOMATICAMENTE **/
                            $('#modal_edit_prod').modal('hide');

                        }
                    }

                }
            }
            

        }




    })
}, false);

//*** CARGA LISTA DE PROVEEDORES****/
function fntCategorias(){
    if(document.querySelector('#categorias')){
        let ajaxUrl = base_url+'categorias/getSelectCategorias';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#categorias').innerHTML = request.responseText;
                $("#categorias").select2();
            }
        }
    }
}

//*** CARGA LISTA DE PROVEEDORES****/
function fntProveedores(){
    if(document.querySelector('#proveedores')){
        let ajaxUrl = base_url+'proveedores/getSelectProveedores';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#proveedores').innerHTML = request.responseText;
                $("#proveedores").select2();
            }
        }
    }
}

//*** EDICION DE PRODUCTO POR MODAL****/
function fntEditInfo(element,idProducto){
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let objProducto = objData.data;
                document.querySelector("#id").value = objProducto.id;
                document.querySelector("#producto").innerHTML = objProducto.producto;
                document.querySelector("#precio").value = objProducto.precio;
                document.querySelector("#stock").value = objProducto.stock;
                document.querySelector("#stock_minimo").value = objProducto.stock_min;
                document.querySelector("#categorias").value = objProducto.id_categoria;
                document.querySelector("#proveedores").value = objProducto.id_proveedor;
                document.querySelector("#estado").value = objProducto.estado;
                $("#categorias").select2();
                $("#proveedores").select2();
                //$("#estado").select2();
            }else{
                swal("Error", objData.msg , "error");
            }
        }
        $('#modal_edit_prod').modal('show');
    }
} 

//*** DELETE PRODUCTO****/
function deleteProducto(idProducto){

    Swal.fire({
        title: 'Desea Eliminar el Producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No, cancelar!",
      }).then((result) => {
        if (result.isConfirmed) {
            
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Productos/delProducto';
        let strData = "idProducto="+idProducto;
        request.open("POST",ajaxUrl,true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                    {
                        console.log(objData);
                        Swal.fire({
                            icon: 'success',
                            title: 'Correcto!.',
                            text: 'Producto Inactivo!',
                            timer: 2200
                          })
                        tableProductos.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                }
            }
        }

        }
      })
        

}

