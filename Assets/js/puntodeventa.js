document.addEventListener('DOMContentLoaded', function(){

    //const base_url = "https://www.tandiltiendashop.com/APP-VENTAS/"; 
    const base_url = "http://localhost/APP-TIENDA/"

    const total = 0;

    //*** BUSCAR PRODUCTO POR CODIGO ****/
    $('#codigo').keypress(function(e) {
        let codigo = document.querySelector("#codigo").value;
        if (codigo !== ""){
        let keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == '13') {
            e.preventDefault();
            let ajaxUrl = base_url+'/productos/getCodigo/'+codigo;
            $.ajax(ajaxUrl, {
                type: 'GET',
                success: (data)=> {
                    let objData = JSON.parse(data);
                    console.log();
                    if(objData.status){
                        $('tbody').append(
                            '<tr>'+
                                '<td>'+
                                    '<button type="button" class="btn btn-outline-default btn-xs"'+
                                        'onclick = "deleteRow(this)">'+
                                        '<i class="fas fa-trash-alt"></i>'+
                                    '</button>'+
                                '</td>'+                                
                                '<td style="font-size: 14px">'+
                                    '<small>' +objData.data.codigo+ '</small><br>' +objData.data.producto+
                                '</td>'+
                                '<td>'+
                                  '<input type="number" class="form-control" id="cantidad" name="cantidad"'+
                                  'value="1" min="1" max="1000" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" onchange ="cambio_cantidad()" style="font-size: 14px">'+
                                '</td>'+
                                '<td style="font-size: 14px">'+objData.data.precio+'</td>'+
                                '<td id="sub_total" name="sub_total" style="font-size: 14px"></td>'+
                            '</tr>'
                            
                        )
                        sumar();  
                  }else{
                    
                     
                    Swal.fire({
                        icon: 'error',
                        title: 'Codigo no Existente!',
                      })
                      $("#codigo").val('').focus();
                    return false;

                  }                     

                },
                error: function (jqXhr, textStatus, errorMessage) {      
                    console.log(errorMessage);
                }
            });

            }
        }else{

            console.log("ingrese un codigo..");
        }
        
    });

    $("#codigo").focus();

}, false);

var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  });


function borar_carga(){

   $("#table_ventas > tbody").empty();
   sumar();
}

function cambio_cantidad(){  
  sumar();
}

 
function deleteRow(r){ 
    var i = r.parentNode.parentNode.rowIndex
    document.getElementById("table_ventas").deleteRow(i);
    sumar();
}

function sumar(){
    let suma_total = 0.00;
    let suma_cantidad = 0;
    let sub_total = 0;

    let cantidad = 0;
    let precio = 0;

    $('#table_ventas tbody tr').each(function() {                       
        
        precio = parseFloat($(this).find('td').eq(3).text()); 

        cantidad = parseFloat($(this).find('input[type=number]').val());

        /**** suma cantidad total****/
        suma_cantidad += cantidad;

        /**** sub total de prodcuto****/
        sub_total = parseFloat(precio * cantidad);

        /**** asigna el subtotal al la columna sub_total****/
        $(this).find('td').eq(4).text(sub_total.toFixed(2));

        /**** suma la cantidad total de productos***/
        suma_total += sub_total;

        $("#codigo").val('').focus();
    });    
    
    document.querySelector('#total_suma').innerHTML = formatter.format(suma_total);
    document.querySelector('#total_cantidad').innerHTML = "Cant. Art: "+suma_cantidad;
}

function cerrar_venta(){
    console.log("click");
    $('#modal_cerrarventa').modal('show');
}


/** MUESTRA LOS DATOS DEL CLIENTE AL MOMNETO DEL CIERRE DE LA VENTA**/
$('#cliente').change(function(){
    let valor = $(this).val();
    let div = $('.cliente');
    if (valor != 1 ){
        div.show("slow");
    }else{
        div.hide("slow");
    }
});

/** MUESTRA FORMA DE PAGO**/
$('#pago').change(function(){
    let f_pado = $(this).val();
    let div = $('.tipo_pago');
    if (f_pado != 1 ){
        div.show("slow");
    }else{
        div.hide("slow");
    }
});



  $('.cliente').hide();
  $('.tipo_pago').hide();





