$(document).ready(function(){

    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var f=new Date();
    $("#fecha_text").text(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
    
    obtenerNumero();

    $("#nombre_para_buscar").on("keyup", ()=>{
        obtenerResultado($("#nombre_para_buscar").val());
    })

    $("#btnAddProducto").click(function(){
        let nombre = $("#NombreProducto").text();
        let codigoProducto = $("#codProducto").text();
        let precio = parseFloat($("#precio").text()).toFixed(2);
        let stock = $("#stock").text();
        let unidades = $("#unidades").text();
        let cantidad = $("#cantidad_producto").val();

        if(nombre !== "__" && codigoProducto !== "__" && precio !== "__" && stock !== "__" && unidades !== "__" && cantidad >= 1){
            $("#tablaSucursal").append(`
            <tr class="text-center">
                <td style="padding: 0; margin: 0;">${codigoProducto}</td>
                <td style="padding: 0; margin: 0;">${nombre}</td>
                <td style="padding: 0; margin: 0;">${cantidad}</td>
                <td style="padding: 0; margin: 0;">${precio}</td>
                <td style="padding: 0; margin: 0;">${parseFloat(precio * cantidad).toFixed(2)}</td>
            </tr>
            `);

            suma();
            calcularVuelto();
        }else{
            alert("Agrege un producto.");
        }
        cargarDatos("");
    });    

    $("#nombre_para_buscar_cliente").keyup(function(){
        obtenerCliente($("#nombre_para_buscar_cliente").val());
    });

    function obtenerCliente(nombrePersona){
        $.ajax({
            type: "POST",
            url: '../controllers/clientes.controller.php',
            data: {nombrePersona: nombrePersona},
            success: function(data, status){
                data = JSON.parse(data);

                if(data.length > 0){
                    $("#dni_cliente").text(data[0].dni);
                    $("#nombre_cliente").text(data[0].nombre + " " + data[0].apellidos);
                }else{
                    $("#nombre_cliente").html("<span class='text-danger'>Sin resultados</span>");
                    $("#dni_cliente").text("-------");
                }
                
            }
        });            
    }

    $("#generar_venta").on("click", function(){
        let resp = confirm("Seguro de generar la venta?");
        let dni_cliente = $("#dni_cliente").text();
        if(resp){
            let info = obtenerTabla();
            $.ajax({
                type: "POST",
                url: '../controllers/venta.controller.php',
                data: {info: JSON.stringify(info), dniCliente: dni_cliente},
                success: function(data, status){
                    console.log(data);
                    obtenerNumero();
                    if(data.includes("0")){
                        console.log("algo salio mal");
                    }else{
                        window.print();
                        limpiarTabla();
                        suma();
                        calcularVuelto();
                    }
                }
            });            
        }
    });
});

function limpiarTabla(){
    $("#tablaSucursal").html("");    
}
const obtenerNumero = ()=>{
    $.ajax({
        type: "POST",
        url: '../controllers/venta.controller.php',
        data: {numeroVenta: "true"},
        success: function(data, status){
            data = JSON.parse(data);
            $("#codVenta").text(" 000" + data[0].codVenta);
        }
    });
}

function obtenerTabla(){
    var myTableArray = [];
    $("#tablaSucursal tr").each(function() {
        var arrayOfThisRow = [];
        var tableData = $(this).find('td');
        if (tableData.length > 0) {
            tableData.each(function() { arrayOfThisRow.push($(this).text()); });
            myTableArray.push(arrayOfThisRow);
        }
    });
    return myTableArray;
}
const obtenerResultado = (textoABuscar)=>{
    $.ajax({
        type: "POST",
        url: '../controllers/productos.controller.php',
        data: {textoABuscar: textoABuscar},
        success: function(data, status){
            data = JSON.parse(data);
            dataLoad = ``;
            
            ((data[0] === null) ? cargarDatos(""): cargarDatos(data[0]));

            for(producto of data){
                dataLoad +=`<tr style="cursor: pointer;">
                                <td style="padding: 0; margin: 0;">${producto.nombreProd}</td>
                                <td style="padding: 0; margin: 0;">${producto.codProducto}</td>
                            </tr>`;
            }
            $("#tablaBusqueda").html(dataLoad);    
            $("#tablaBusqueda > tr").click(function(e) {
    //          showMessage("Documento " + $(this).find("td:eq(0)").text() + " seleccionado.","info");          
                codigoCliente = $(this).find("td:eq(1)").text();
//                editarProducto(codigoCliente);
                obtenerProducto(codigoCliente);
            });
        }
    });
}

$("#tablaSucursal").click(function(e){
    $(e.target).parent().remove();
    suma();
    calcularVuelto();
});

const obtenerProducto = (codigoProducto)=>{
    $.ajax({
        type: "POST",
        url: '../controllers/productos.controller.php',
        data: {codigoProducto: codigoProducto},
        success: function(data, status){
            data = JSON.parse(data);
            dataLoad = ``;
            ((data[0] === null) ? cargarDatos(""): cargarDatos(data[0]));
        }
    });
}

$("#dinero_entregado").keyup(function(){
    calcularVuelto();
});

function calcularVuelto(){
    let dineroEntregado = parseFloat(($("#dinero_entregado").val() === "") ? "0": $("#dinero_entregado").val());
    let total = parseFloat($("#total").text());
    let vuelto = dineroEntregado - total;
    $("#vuelto").text(vuelto.toFixed(2));
}

function suma(){
    var suma = 0;
    $("#tablaSucursal > tr").each(function(e) {
        suma += parseFloat($(this).find('td').eq(4).text()||0,10);
    });
    $("#total").text(suma.toFixed(2));
}


function cargarDatos(producto){
    if(producto === undefined || producto === ""){
        $("#NombreProducto").text("__");
        $("#codProducto").text("__");

        $("#precio").text("__");
        $("#stock").text("__");
        $("#unidades").text("__");
        $("#cantidad_producto").val(1);
    }else{
        $("#NombreProducto").text(producto.nombreProd );
        $("#codProducto").html(producto.codProducto);

        $("#precio").html(producto.precio);
        $("#stock").html(producto.stock);
        $("#unidades").html(producto.nombreForma);
        $("#cantidad_producto").val(1);
    }
}
