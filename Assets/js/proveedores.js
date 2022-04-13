//const base_url = "https://www.tandiltiendashop.com/APP-VENTAS/"; 

const base_url = "http://localhost/APP-TIENDA/"

/************************* LISTADO DE PROVEEDORES ******************************/
let tableProveedores;
let rowTable = "";

document.addEventListener('DOMContentLoaded', function(){

tableProveedores = $('#tableProveedores').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"proveedores/getProveedores",
        "dataSrc":""
    },
    "columns":[
        
        {"data":"imagen"},
        {"data":"proveedor"},
        {"data":"descripcion"},
        {"data":"estado"},
        {"data":"options"}
    ],           
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "bDestroy": true,
    "iDisplayLength": 25,
    "order":[[0,"desc"]]  
});


//**** PROVEEDOR ****/
let formProveedor = document.querySelector("#formProveedor");
formProveedor.onsubmit = function(e) {
    e.preventDefault();
        let proveedor = document.querySelector('#proveedor').value;
        let estado = document.querySelector('#estado').value;       
    if(proveedor == '' || estado == '')
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
    let ajaxUrl = base_url+'proveedores/setProveedores'; 
    let formData = new FormData(formProveedor);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
        if(objData.status)
            { 
            if(rowTable == ""){
                tableProveedores.api().ajax.reload();
            }
                Swal.fire({
                    icon: 'success',
                    title: 'Registro Guardado.',
                    text: 'Correcto!',
                    timer: 2200
                              })

        /*** CIERRE MODAL AUTOMATICAMENTE **/
        $('#modal_edit_proveedores').modal('hide');

            }else{

                Swal.fire({
                    icon: 'error',
                    title: objData.msg,
                    text: 'Error!'
                        })
                    }
                }

            }
}

}, false);

    
            


function openModal()
{
    rowTable = "";
    document.querySelector('#id_proveedor').value ="";
    document.querySelector('#btnText').innerHTML =" Guardar";
    document.querySelector('#titleModal').innerHTML = " Nuevo Proveedor";
    document.querySelector("#formProveedor").reset();
    $('#modal_edit_proveedor').modal('show');

}

//*** DELETE PROVEEDOR ****/
function editProveedor(id_proveedor){
    document.querySelector('#titleModal').innerHTML ="Actualizar Proveedor";
    document.querySelector('#btnText').innerHTML =" Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'proveedores/getProveedor/'+id_proveedor;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
            let objdata = objData.data;
            document.querySelector("#id_proveedor").value = objdata.id_proveedor;
            document.querySelector("#proveedor").value = objdata.proveedor;
            document.querySelector("#descripcion").value = objdata.descripcion;
            document.querySelector("#estado").value = objdata.estado;
            $('#modal_edit_proveedor').modal('show');

            }
        }
    }
    

} 

//*** DELETE PROVEEDOR ****/
function deleteProveedor(id_proveedor){

    Swal.fire({
        title: 'Desea Eliminar el Proveedor?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No, cancelar!",
      }).then((result) => {
        if (result.isConfirmed) {
            
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/proveedores/deleteProveedor';
        let strData = "idproveedor="+id_proveedor;
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
                            text: 'Proveedor Inactivo!',
                            timer: 2200
                          })
                        tableProveedores.api().ajax.reload();
                    }else{
                        Swal.fire("Atención!", objData.msg , "error");
                }
            }
        }

        }
      })
        
    }

