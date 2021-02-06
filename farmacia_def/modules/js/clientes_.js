$(document).ready(()=>{
    listarClientes();


});

$("#formularioClientes").on("submit", (e)=>{
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: '../controllers/clientes.controller.php',
      data: $("#formularioClientes").serialize(),
      success: function(data, status){ 
        data = JSON.parse(data);
        if(data === 1){
            showMessage("Agregado correctamente.", "success");
            resetForm($("#formularioClientes"));
            listarClientes();
        }else if(data === 0){
            showMessage("No se agregó", "danger");
        }
        $("#modalAgregarUsuario").modal("hide");
      }
    });
});

const listarClientes = ()=>{
    $.ajax({
      type: "POST",
      url: '../controllers/clientes.controller.php',
      data: {list: "list"},
      success: function(data, status){ 
        data = JSON.parse(data);
        let dataLoad = ``;
        correlativo = 0;
        for(cliente of data){
            correlativo++;
            dataLoad +=`<tr style="cursor: pointer;">
                <th>${correlativo}</th>
                <td>${cliente.dni}</td>
                <td>${cliente.nombre} ${cliente.apellidos}</td>
                <td>${cliente.direccion}</td>
                <td>${cliente.telefono}</td>
            </tr>`;
        }
        $("#tablaClientes").html(dataLoad);
        
        $("tr").click(function(e) {
//          showMessage("Documento " + $(this).find("td:eq(0)").text() + " seleccionado.","info");          
            codigoCliente = $(this).find("td:eq(0)").text();
            editarCliente(codigoCliente);
        });
    
      }
    });
  }

const editarCliente = (dniCliente)=>{
    $.ajax({
        type: "POST",
        url: '../controllers/clientes.controller.php',
        data: {dniCliente: dniCliente, readOne: "true"},
        success: function(data, status){
            data = JSON.parse(data);
            $("#dniUpd").val(data[0].dni);
            $("#nombreUpd").val(data[0].nombre);
            $("#apellidosUpd").val(data[0].apellidos);
            $("#direccionUpd").val(data[0].direccion);
            $("#telefonoUpd").val(data[0].telefono);
            $("#modalEditarUsuario").modal("show");
        }
    });
}

$("#formularioUpdClientes").on("submit", (e)=>{
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: '../controllers/clientes.controller.php',
      data: $("#formularioUpdClientes").serialize(),
      success: function(data, status){ 
        data = JSON.parse(data);
        if(data === 1){
            showMessage("Guardado correctamente.", "success");
            resetForm($("#formularioUpdClientes"));
            listarClientes();
        }else if(data === 0){
            showMessage("Sin cambios", "danger");
        }
        $("#modalEditarUsuario").modal("hide");
      }
    });
});

$("#btnReload").on("click", ()=>{
    listarClientes();
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
    if(event.charCode >= 48 && event.charCode <= 57){
        return true;
    }
    return false;        
}