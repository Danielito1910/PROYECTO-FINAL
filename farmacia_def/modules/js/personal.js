$(document).ready(()=>{
    listarProfesionales();
    listarDocumentos();
    listarCargos();
    listarUnidades();
    var codigoProfesional = "";
    $("#modal-dialog").draggable({
      handle: ".modal-header"
    });
    $("#modal-dialogProfesional").draggable({
      handle: ".modal-header"
    });

});

$("#tipoDoc").change(function(){
  let tipoDocumento= $("#tipoDoc").val();
  if(tipoDocumento == 2){
    let dni = $("#dniProfesional").val();
    $("#dniProfesional").val(dni.substring(0,7));
    $("#dniProfesional").attr('maxlength', 8);
  }else{
    $("#dniProfesional").attr('maxlength', 12);
  }
});


$("#btnEditar").on("click", ()=>{
  if(typeof(codigoProfesional) === "undefined" || codigoProfesional === ""){
    showMessage("Seleccione una fila.", "danger");
  }else{
    //lenar modal con datos del profesional para un update
    $.ajax({
      type: "POST",
      url: '../controllers/personal.controller.php',
      data: {codigoProfesional: codigoProfesional, readOne: "readOne"},
      success: function(data, status){ 
        data = JSON.parse(data);
        console.log(data);

        $("#docProfesional").val(data[0].TIPO_DOCUMENTO);
        $("#numDocProf").val(data[0].DOCUMENTO);
        $("#nombreProfesional").val(data[0].NOMBRE);
        $("#apellidoPatProf").val(data[0].APELLIDO_PAT);
        $("#apellidoMatProf").val(data[0].APELLIDO_MAT);
        $("#colegiaturaProfesional").val(data[0].colegiatura);
        $(`#cargoUpdProfesional > option[value=${data[0].CARGO_idCARGO}]`).attr("selected",true);
      }
    });
    listarServiciosAtenc(codigoProfesional);
    //llenar código del formulario
    $("#codigoProf").val(codigoProfesional);
    $("#modalEditarProfesional").modal("show");    
  }
}); 

$("#idFormularioUpdProfesional").on("submit", (e)=>{
  e.preventDefault();
  if($("#idFormularioUpdProfesional").valid()){
    $.ajax({
      type: "POST",
      url: '../controllers/personal.controller.php',
      data: $("#idFormularioUpdProfesional").serialize() + "&udpate=update",
      success: function(data, status){
        console.log(data);
        if(data === "0"){
          $("#modalEditarProfesional").modal("hide");
          $("#showMessage").html(`<div class="alert alert-danger p-1">Sin cambios.</div>`);
        }else{
          listarProfesionales();
          $("#modalEditarProfesional").modal("hide");
          resetForm($("#formularioPersonal"));
          $("#showMessage").html(`<div class="alert alert-success p-1">Actualizado correctamente.</div>`);
        }
        setTimeout(()=>{
          $("#showMessage").html(``);
        }, 1500);
      }
    });
  }
});

$("#btnDarBaja").on("click", ()=>{
  let resp = confirm("Seguro de dar de baja el registro ?");
  if(resp){
    if(typeof(codigoProfesional) === "undefined" || codigoProfesional === ""){
      showMessage("Seleccione una fila.", "danger");
    }else{
      //lenar modal con datos del profesional para un update
      $.ajax({
        type: "POST",
        url: '../controllers/personal.controller.php',
        data: {codigoProfesional: codigoProfesional, darBaja: "darBaja"},
        success: function(data, status){ 
          data = JSON.parse(data);
          listarProfesionales();
        }
      });
    }
  } 
});


/*Dado un código lista los servicios que atiende*/
const listarServiciosAtenc = (codigoProfesional)=>{
    //lenar los servicios que atiende
    $.ajax({
      type: "POST",
      url: '../controllers/personal.controller.php',
      data: {codigoProfesional: codigoProfesional, readAtencion:"readAtencion"},
      success: function(data, status){ 

        data = JSON.parse(data);
        let dataLoad = ``;
        correlativo = 0;
        for(servicio of data){
            correlativo++;
            dataLoad +=`
            <tr style="cursor: pointer;">
                <td>${correlativo}</td>
                <td>${servicio.UNIDAD_SERVICIO}</td>
                <td><input type="button" class="btn btn-warning btn-sm" value="borrar" onclick="borrarOfAsignada(${servicio.id_unidad}, ${servicio.profesional_id_PROFESIONAL}, ${codigoProfesional})"></td>
            </tr>`;
        }
        $("#tablaServicios").html(dataLoad);
      }
    });
}
function borrarOfAsignada(idUnidad, idProfesional, codigoProfesional){
  $.ajax({
    type: "POST",
    url: '../controllers/personal.controller.php',
    data: {idUnidad: idUnidad, idProfesional: idProfesional},
    success: function(data, status){
      if(data === "0"){
        alert("No puede borrar la unidad actualmente asignada.");
      }else{
        alert("Borrado.");
      }
      listarServiciosAtenc(codigoProfesional);
    }
  });
}

/**Añadir servicio. */
$("#serviciosAtencion").on("submit", (e)=>{
  e.preventDefault();
  
  $.ajax({
    type: "POST",
    url: '../controllers/personal.controller.php',
    data: $("#serviciosAtencion").serialize(),
    success: function(data, status){ 
      data = JSON.parse(data);
      if(data.status === "ok"){
        showMessage("Agregado correctamente.", "success");
        listarServiciosAtenc($("#codigoProf").val());
      }else if(data.status === "err"){
        showMessage(data.info, "danger");
      }

    }
  });
});

/**Listar unidades servicios */
const listarUnidades = ()=>{
  $.ajax({
    type: "POST",
    url: '../controllers/unidades.controller.php',
    data: "listServices",
    success: function(data, status){ 
      data = JSON.parse(data);
      selectData = ``;
      for(unidad of data){
          selectData += `
              <option value="${unidad.id_UNIDAD}">${unidad.UNIDAD_SERVICIO}</option>
          `;
      }
      $('#unidadesAsignar').html(selectData);
    }
  });
}



/*función: traer datos mediante un nombre/apellido o numero de documento*/
const listarProfesionales = ()=>{
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
            color = "";
            if(personal.estado === "activo"){
              color = "black";
            }else{  
              color = "red";
            }

            dataLoad +=`<tr style="cursor: pointer; color:${color}">
                <th>${correlativo}</th>
                <td>${personal.documento}</td>
                <td>${personal.nombres}</td>
                <td>${personal.colegiatura}</td>
                <td>${personal.CARGO}</td>
            </tr>`;
        }
        $("#tablaPersonal").html(dataLoad);
        $("tr").click(function(e) {

          showMessage("Documento " + $(this).find("td:eq(0)").text() + " seleccionado.","info");          
          codigoProfesional = $(this).find("td:eq(0)").text();
        });
    
      }
    });
  }

  const showMessage = (mensaje, tipo)=>{
    $("#showMessage").html(`<div class="alert alert-${tipo} p-1">${mensaje}</div>`);
          setTimeout(()=>{
            $("#showMessage").html(``);
          }, 1500)
  }
  /*Mostrar modal y cargar datos, dado un número de documento*/
  const loadData = (documento)=>{
    if(documento === ""){
      showMessage("Seleccione una fila por favor.", "danger")
    }else{
      
        //obtener los datos


    }
  }

  /**Guardar datos */
  $("#formularioPersonal").on("submit", (e)=>{
    e.preventDefault();
    if($("#formularioPersonal").valid()){
      $.ajax({
        type: "POST",
        url: '../controllers/personal.controller.php',
        data: $("#formularioPersonal").serialize() + "&save=save",
        success: function(data, status){ 
          console.log(data);
          if(data === "0"){
            $("#modalAgregarProfesional").modal("hide");
            $("#showMessage").html(`<div class="alert alert-danger p-1">Error - compruebe los datos.</div>`);
          }else{
            listarProfesionales();
            $("#modalAgregarProfesional").modal("hide");
            resetForm($("#formularioPersonal"));
            $("#showMessage").html(`<div class="alert alert-success p-1">Agregado correctamente.</div>`);
          }
          setTimeout(()=>{
            $("#showMessage").html(``);
          }, 1500);
        }
      });
    }      
  });


  /*Actualizar lista*/
  $("#btnReload").on("click", ()=>{
      listarProfesionales();
  });

  /*Listar documentos*/
  const listarDocumentos = ()=>{
    $.ajax({
      type: "POST",
      url: '../controllers/documento.controller.php',
      data: "Read",
      success: function(data, status){ 
        data = JSON.parse(data);
        selectData = ``;
        for(documento of data){
            selectData += `
                <option value="${documento.id_TIPO_DOC}">${documento.TIPO_DOCUMENTO}</option>
            `;
        }
        $('#tipoDoc').html(selectData);
      }
    });
  }
  /**Listar cargos */
const listarCargos = ()=>{
  $.ajax({
    type: "POST",
    url: '../controllers/cargo.controller.php',
    data: "Read",
    success: function(data, status){ 
      data = JSON.parse(data);
      selectData = ``;
      for(cargo of data){
          selectData += `
              <option value="${cargo.id_CARGO}">${cargo.CARGO}</option>
          `;
      }
      $('#cargoProfesional').html(selectData);
      $('#cargoUpdProfesional').html(selectData);
    }
  });
}
const resetForm = (form)=>{
  form[0].reset();
}


/*Validar numericos*/
function validaNumericos(event) {
  if(event.charCode >= 48 && event.charCode <= 57){
    return true;
   }
   return false;        
}