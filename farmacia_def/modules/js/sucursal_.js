$(document).ready(()=>{
    listarSucursal();
});
const listarSucursal = ()=>{
    $.ajax({
      type: "POST",
      url: '../controllers/farmacia.controller.php',
      data: {list: "list"},
      success: function(data, status){ 
        data = JSON.parse(data);
        let dataLoad = ``;
        correlativo = 0;
        for(farmacia of data){
            correlativo++;
            dataLoad +=`<tr style="cursor: pointer;">
                <th>${correlativo}</th>
                <td>${farmacia.nombre}</td>
                <td>${farmacia.direccion}</td>
                <td>${farmacia.celular}</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editarSucursal(${farmacia.idsucursal})">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="borrarSucursal(${farmacia.idsucursal})">Borrar</button>
                </td>
            </tr>`;
        }
        $("#tablaSucursal").html(dataLoad);    
      }
    });
  }

const editarSucursal = (codigoSucursal)=>{
    $.ajax({
        type: "POST",
        url: '../controllers/farmacia.controller.php',
        data: {codigoSucursal: codigoSucursal, readOne: "true"},
        success: function(data, status){
            data = JSON.parse(data);

            $("#nombreUpd").val(data[0].nombre);
            $("#direccionUpd").val(data[0].direccion);
            $("#telefonoUpd").val(data[0].celular);
            $("#codSucursal").val(data[0].idsucursal);
 
            $("#modalEditarSucursal").modal("show");
        }
    });
}

$("#formularioSucursalUpd").submit((e)=>{
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: '../controllers/farmacia.controller.php',
        data: $("#formularioSucursalUpd").serialize() + "&edit=true",
        success: function(data, status){
          console.log(data);
          data = JSON.parse(data);
          console.log(data);
          if(data === 1){
              showMessage("Guardado correctamente.", "success");
              resetForm($("#formularioSucursalUpd"));
              listarSucursal();
          }else if(data === 0){
              showMessage("Sin cambios", "danger");
          }
          $("#modalEditarSucursal").modal("hide");
        }
      });
});

$("#formularioSucursal").submit((e)=>{
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: '../controllers/farmacia.controller.php',
        data: $("#formularioSucursal").serialize() + "&set=true",
        success: function(data, status){
          console.log(data);
          data = JSON.parse(data);
          console.log(data);
          if(data === 1){
              showMessage("Guardado correctamente.", "success");
              resetForm($("#formularioSucursal"));
              listarSucursal();
          }else if(data === 0){
              showMessage("Sin cambios", "danger");
          }
          $("#modalAgregarSucursal").modal("hide");
        }
      });
});
$("#btnReload").on("click", ()=>{
    listarSucursal();
    showMessage("Actualizado", "info");
});
const borrarSucursal = (idsucursal)=>{
    let resp = confirm("Estás seguro de borrar? la información no podrá recuperarse.");
    if(resp){
        $.ajax({
            type: "POST",
            url: '../controllers/farmacia.controller.php',
            data: {idsucursal: idsucursal, delete: "delete"},
            success: function(data, status){
                data = JSON.parse(data);
                if(data === 1){
                    showMessage("Guardado correctamente.", "success");
                    resetForm($("#formularioSucursal"));
                    listarSucursal();
                }else if(data === 0){
                    showMessage("Sin cambios", "danger");
                }
            }
        });
    }
}

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
