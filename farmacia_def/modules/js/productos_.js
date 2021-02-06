$(document).ready(()=>{
    listarProductos();
    listarFormas();
});
const listarProductos = ()=>{
    $.ajax({
      type: "POST",
      url: '../controllers/productos.controller.php',
      data: {list: "list"},
      success: function(data, status){ 
        data = JSON.parse(data);
        let dataLoad = ``;
        correlativo = 0;
        for(producto of data){
            correlativo++;
            dataLoad +=`<tr style="cursor: pointer;">
                <th>${correlativo}</th>
                <td>${producto.codProducto}</td>
                <td>${producto.nombreProd}</td>
                <td>${producto.composicion}</td>
                <td>${producto.marca}</td>
                <td>${producto.precio}</td>
                <td>${producto.stock}</td>
                <td>${producto.nombreForma}</td>
                <td>
                <button class="btn btn-info btn-sm" onclick="editarProducto('${producto.codProducto}')">Editar</button>
                </td>
            </tr>`;
        }
        $("#tablaProductos").html(dataLoad);
        

    
      }
    });
  }

  const editarProducto = (codigoProducto)=>{
    $.ajax({
        type: "POST",
        url: '../controllers/productos.controller.php',
        data: {codigoProducto: codigoProducto, readOne: "true"},
        success: function(data, status){
            data = JSON.parse(data);
            $("#codProductoUpd").val(data[0].codProducto);
            $("#nombreProductoUpd").val(data[0].nombreProd);
            $("#composicionUpd").val(data[0].composicion);
            $("#marcaUpd").val(data[0].marca);
            $("#precioUpd").val(data[0].precio);
            $("#stockUpd").val(data[0].stock);
            $(`#formaUpd > option[value=${data[0].idforma}]`).attr("selected",true);

            $("#modalEditarProducto").modal("show");
        }
    });
  }

  const listarFormas = ()=>{
    $.ajax({
      type: "POST",
      url: '../controllers/productos.controller.php',
      data: {listFormas: "listFormas"},
      success: function(data, status){ 
        data = JSON.parse(data);
        let dataLoad = ``;
        correlativo = 0;
        for(forma of data){
            correlativo++;
            dataLoad +=`
                <option value="${forma.idforma}">${forma.nombreForma}</option>
            `;
        }
        $("#forma").html(dataLoad);
        $("#formaUpd").html(dataLoad);
        }
    });
  }

$("#formularioProductoUpd").on("submit", (e)=>{
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: '../controllers/productos.controller.php',
      data: $("#formularioProductoUpd").serialize() + "&edit=true",
      success: function(data, status){
        console.log(data);

        data = JSON.parse(data);
        console.log(data);

        if(data === 1){
            showMessage("Guardado correctamente.", "success");
            resetForm($("#formularioProductoUpd"));
            listarProductos();
        }else if(data === 0){
            showMessage("Sin cambios", "danger");
        }
        $("#modalEditarProducto").modal("hide");
      }
    });
});


$("#formularioProducto").on("submit", (e)=>{
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: '../controllers/productos.controller.php',
      data: $("#formularioProducto").serialize()+"&save=save",
      success: function(data, status){ 
          console.log(data);
        data = JSON.parse(data);
        if(data === 1){
            showMessage("Agregado correctamente.", "success");
            resetForm($("#formularioProducto"));
            listarProductos();
        }else if(data === 0){
            showMessage("No se agregó", "danger");
        }
        $("#modalAgregarProducto").modal("hide");
      }
    });
});



$("#btnReload").on("click", ()=>{
    listarProductos();
    showMessage("Actualizado", "info");
});
const resetForm = (form)=>{
    form[0].reset();
}
const showMessage = (mensaje, tipo)=>{
    $("#showMessage").html(`<div class="alert alert-${tipo} p-1">${mensaje}</div>`);
        setTimeout(()=>{
        $("#showMessage").html(``);
        }, 1500)
}
/*Validar numericos*/
function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57 || event.charCode <= 46){
        return true;
    }
    return false;        
}