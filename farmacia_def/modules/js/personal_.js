$(document).ready(()=>{
    listarPersonal();
    listarSucursal();
});
const listarPersonal = ()=>{
    $.ajax({
      type: "POST",
      url: '../controllers/personal.controller.php',
      data: {list: "list"},
      success: function(data, status){ 
        data = JSON.parse(data);
        let dataLoad = ``;
        correlativo = 0;
        for(personal of data){
            correlativo++;
            dataLoad +=`<tr style="cursor: pointer;">
                <th>${correlativo}</th>
                <td>${personal.usuario}</td>
                <td>${personal.nombres}</td>
                <td>${personal.apellidos}</td>
                <td>${personal.telefono}</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="editarPersonal(${personal.usuario})">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="borrarPersonal(${personal.usuario})">Borrar</button>
                </td>
            </tr>`;
        }
        $("#tablaUsuarios").html(dataLoad);    
      }
    });
  }

$("#formularioPersonal").on("submit", (e)=>{
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: '../controllers/personal.controller.php',
      data: $("#formularioPersonal").serialize()+"&save=save",
      success: function(data, status){ 
        console.log(data);
        data = JSON.parse(data);
        if(data === 1){
            showMessage("Agregado correctamente.", "success");
            resetForm($("#formularioPersonal"));
            listarPersonal();
        }else if(data === 0){
            showMessage("No se agregó. Revise el DNI.", "danger");
        }
        $("#modalAgregarPersonal").modal("hide");
      }
    });
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
        for(sucursal of data){
            correlativo++;
            dataLoad +=`
                <option value="${sucursal.idsucursal}">${sucursal.nombre}</option>
            `;
        }
        $("#sucursal").html(dataLoad);
        $("#sucursalUpd").html(dataLoad);
        }
    });
  }

const editarPersonal = (codigoPersona)=>{
    $.ajax({
        type: "POST",
        url: '../controllers/personal.controller.php',
        data: {codigoPersona: codigoPersona, readOne: "true"},
        success: function(data, status){
            data = JSON.parse(data);

            $("#usuarioUpd").val(data[0].usuario);
            $("#nombreUpd").val(data[0].nombres);
            $("#apellidosUpd").val(data[0].apellidos);
            $("#telefonoUpd").val(data[0].telefono);
            $(`#tipoUpd > option[value=${data[0].tipo}]`).attr("selected",true);
            $(`#sucursalUpd > option[value=${data[0].idsucursal}]`).attr("selected",true);
 
            $("#modalEditarPersonal").modal("show");
        }
    });
}


const borrarPersonal = (codigoPersona)=>{
    let resp = confirm("Seguro de borrar el registro? la información no podrá recuperarse.");
    if(resp){
        $.ajax({
            type: "POST",
            url: '../controllers/personal.controller.php',
            data: {usuarioUpd: codigoPersona, delete: "true"},
            success: function(data, status){
                console.log(data);
                data = JSON.parse(data);
                if(data === 1){
                    showMessage("Borrado", "success");
                    listarPersonal();
                }else{
                    showMessage("No se borró", "danger");
                }     
            }
        });
    }
}
  
$("#formularioPersonalUpd").on("submit", (e)=>{
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: '../controllers/personal.controller.php',
      data: $("#formularioPersonalUpd").serialize() + "&edit=true",
      success: function(data, status){
        console.log(data);

        data = JSON.parse(data);
        console.log(data);

        if(data === 1){
            showMessage("Guardado correctamente.", "success");
            resetForm($("#formularioPersonalUpd"));
            listarPersonal();
        }else if(data === 0){
            showMessage("Sin cambios", "danger");
        }
        $("#modalEditarPersonal").modal("hide");
      }
    });
});
$("#btnReload").on("click", ()=>{
    listarPersonal();
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
