
//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
//$('.select3').select3()

const base_url = "http://localhost/APP-TIENDA/"; 

document.addEventListener('DOMContentLoaded', function(){

    let codigo = document.getElementById('codigo');

    codigo = codigo.value == "" ? codigo.readOnly = false : codigo.readOnly = true;

    //if(codigo){codigo.disabled=false;}

//**** INGRESO DE PRODUCTO ****/
window.addEventListener('load', function() {
    if(document.querySelector("#formInsertProducto")){
        let formProductos = document.querySelector("#formInsertProducto");
        formProductos.onsubmit = function(e) {
            e.preventDefault();
            let idproducto = document.querySelector('#idproducto').value;
            let strcodigo = document.querySelector('#codigo').value;
            let strproducto = document.querySelector('#producto').value;
            let strdescripcion = document.querySelector('#descripcion').value;
            let intcosto = document.querySelector('#costo').value;
            let strPrecio = document.querySelector('#precio').value;
            let intStock = document.querySelector('#stock').value;
            let intStock_min = document.querySelector('#stock_minimo').value;
            let intCategoria = document.querySelector('#categorias').value;
            let intProveedor = document.querySelector('#proveedores').value;
            let intEstado = document.querySelector('#estado').value;

            if(strcodigo == '' || strproducto == '' || strdescripcion == '' || intcosto == '' || 
                strPrecio == '' || intStock == '' || intStock_min == '')
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Verificar los campor del formulario.',
                    text: 'Error!'
                  })
            return false;
            }

            let request = (window.XMLHttpRequest) ? 
                        new XMLHttpRequest() : 
                        new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'pag_Producto/setProducto'; 
            let formData = new FormData(formProductos);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);

                    if(objData.status)
                    { 
                        Swal.fire({
                                icon: 'success',
                                title: 'Registro Guardado.',
                                text: 'Correcto!',
                                timer: 2200,
                              })
                              formProductos.reset();
                    }else{

                        Swal.fire({
                            icon: 'error',
                            title: objData.msg,
                            text: 'Error!'
                          })
                    return false;

                    }
                }

            }
        }
        

    }




});

}, false);