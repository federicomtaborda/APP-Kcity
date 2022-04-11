/************************* LISTADO DE PRODUCTOS ******************************/
let tableCategorias;
let rowTable = "";

//const base_url = "https://www.tandiltiendashop.com/APP-VENTAS/";

const base_url = "http://localhost/APP-TIENDA/"


document.addEventListener('DOMContentLoaded', function(){

tableCategorias = $('#tableCategorias').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"categorias/getCategorias",
        "dataSrc":""
    },
    "columns":[
        
        {"data":"imagen"},
        {"data":"categoria"},
        {"data":"descripcion"},
        {"data":"estado"},
        {"data":"options"}
    ],           
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "bDestroy": true,
    "iDisplayLength": 25,
    "order":[[0,"desc"]]  
});

window.addEventListener('load', function(){
    if(document.querySelector("#formCategoria")){
        let formCategoria = document.querySelector("#formCategoria");
            formCategoria.onsubmit = function(e) {
            e.preventDefault();
            let id_categoria = document.querySelector("#id_categoria").value;
            let categoria = document.querySelector("#categoria").value;
            let descripcion = document.querySelector("#descripcion").value;
            let estado = document.querySelector("#estado").value;

            if(categoria == '' || estado == '')
            {
                Swal.fire({
                    icon: 'error',
                    title: objData.msg,
                    text: 'Error!'
                  })
                return false;
            }

            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'categorias/setCategoria'; 
            let formData = new FormData(formCategoria);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        if(rowTable == ""){
                            tableCategorias.api().ajax.reload();
                        }                        
                        Swal.fire({
                                icon: 'success',
                                title: 'Registro Guardado.',
                                text: 'Correcto!',
                                timer: 2200
                              })
                        formCategoria.reset();
                        /*** CIERRE MODAL AUTOMATICAMENTE **/
                        $('#modal_edit_categoria').modal('hide');
                    }else{

                            Swal.fire({
                                icon: 'error',
                                title: objData.msg,
                                text: 'Error!'
                            })
                        }
                    }
                    
                    return false;
                }
            }
        }

})

}, false);

function editCategoria(id_categoria){
    document.querySelector('#titleModal').innerHTML ="Actualizar Categoria";
    document.querySelector('#btnText').innerHTML =" Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'categorias/getCategoria/'+id_categoria;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            
            if(objData.status){

            let objProducto = objData.data;
            document.querySelector("#id_categoria").value = objProducto.id_categoria;
            document.querySelector("#categoria").value = objProducto.categoria;
            document.querySelector("#descripcion").value = objProducto.descripcion;
            document.querySelector("#estado").value = objProducto.estado;


            $('#modal_edit_categoria').modal('show');

            }
        }
    }
    
    



} 

function openModal()
{
    rowTable = "";
    document.querySelector('#id_categoria').value ="";
    document.querySelector('#btnText').innerHTML =" Guardar";
    document.querySelector('#titleModal').innerHTML = " Nueva Categoria";
    document.querySelector("#formCategoria").reset();
    $('#modal_edit_categoria').modal('show');

}

//*** DELETE CATEGORIA ****/
function deleteCategoria(idCategoria){

    Swal.fire({
        title: 'Desea Eliminar la categoria?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No, cancelar!",
      }).then((result) => {
        if (result.isConfirmed) {
            
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'categorias/deleteCategoria';
        let strData = "idCategoria="+idCategoria;
        request.open("POST",ajaxUrl,true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(strData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Correcto!.',
                            text: 'Categoria Inactiva!',
                            timer: 2200
                          })
                        tableCategorias.api().ajax.reload();
                    }else{
                        Swal.fire("Atención!", objData.msg , "error");
                }
            }
        }

        }
      })
        

}
