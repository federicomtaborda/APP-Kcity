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
                    if(objData.status){
                        $('tbody').append(
                            '<tr>'+
                                '<td>'+
                                    '<button type="button" class="btn btn-outline-default btn-xs"'+
                                        'onclick = "deleteRow(this)">'+
                                        '<i class="fas fa-trash-alt"></i>'+
                                    '</button>'+
                                '</td>'+
                                '<td style="font-size: 15px">'+objData.data.producto+'</td>'+
                                '<td>'+
                                  '<input type="number" class="form-control" id="cantidad" name="cantidad" value="1">'+
                                '</td>'+
                                '<td>'+objData.data.precio+'</td>'+
                            '</tr>'
                        )
                        Sumar();  
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

}, false);

 
function deleteRow(r){ 
    var i = r.parentNode.parentNode.rowIndex
    document.getElementById("table_ventas").deleteRow(i);
    Sumar();
}

function Sumar(){
    let suma_total = 0;
    let suma_cantidad = 0;
    $('#table_ventas tbody tr').each(function() {                       
        suma_cantidad += $(this).find('input').eq(2).text();     
        suma_total += parseFloat($(this).find('td').eq(3).text());   
        console.log( $(this).find('input').eq(2).text() );         
    });    
    
    document.querySelector('#total_suma').innerHTML = "$"+suma_total; 
    document.querySelector('#total_cantidad').innerHTML = suma_cantidad; 
}





