$(document).ready(()=>{

    obtenerUnidadActual();
    obtenerUnidades();
    getUserData();


});

const obtenerUnidadActual = ()=>{
    $.ajax({
        type: "POST",
        url: '../controllers/personal.controller.php',
        data: {obtenerUnidadActual: 'obtenerUnidadActual'},
        success: function(data, status){ 
            data = JSON.parse(data);            
            if(data.length > 0){
                $("#currentAtencion").text(data[0].UNIDAD_SERVICIO);                
            }else{
                $("#currentAtencion").text("--No asignado--");                
            }
        }
    });
    
}
const obtenerUnidades = ()=>{
    $.ajax({
        type: "POST",
        url: '../controllers/personal.controller.php',
        data: {obtenerUnidades: 'obtenerUnidades'},
        success: function(data, status){ 
            data = JSON.parse(data);
            
            let dataLoad = ``;
            let dataLoadSelect = ``;
            for(unidad of data){
                if(unidad.unidad_actual === "1"){
                    dataLoad +=`
                    <li class="list-group-item list-group-item-info">${unidad.UNIDAD_SERVICIO}</li>
                    `;
                }else{
                    dataLoad +=`
                    <li class="list-group-item">${unidad.UNIDAD_SERVICIO}</li>
                    `;
                }
            }
            $("#listaUnidades").html(dataLoad);
            dataLoad = ``;
            for(unidad of data){
                dataLoad +=`
                <option value="${unidad.unidad_servicio_id_UNIDAD}">${unidad.UNIDAD_SERVICIO}</option>
                `;
            }

            $("#unidadAtencion").html(dataLoad);

        }
    });
    
}
$("#formUpdateCurrent").submit((e)=>{
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: '../controllers/personal.controller.php',
        data: $("#formUpdateCurrent").serialize() + "&nombreOficina="+$('#unidadAtencion option:selected').text(),
        success: function(data, status){
            console.log(data);
            data = JSON.parse(data);
            obtenerUnidadActual();
            obtenerUnidades();
            if(data === 1){
                $("#alert-save").html(`
                <div class="alert alert-primary">Hecho </div>`);
                setTimeout(()=>{
                    $("#alert-save").html(``);
                }, 2000);
            }else{

            }
        },
        complete: function(a,b,c){
            location.reload();
        }
    });

});

const getUserData = ()=>{
    $.ajax({
        type: "POST",
        url: '../controllers/personal.controller.php',
        data: {getCurrentUser: "getCurrentUser"},
        success: function(data, status){ 
            data = JSON.parse(data);
            $("#tipoDoc").val(data[0].TIPO_DOCUMENTO);
            $("#dniProfesional").val(data[0].DOCUMENTO);
            $("#nombreUsuario").val(data[0].NOMBRE);
            $("#apellidoPaterno").val(data[0].APELLIDO_PAT);
            $("#apellidoMaterno").val(data[0].APELLIDO_MAT);
            $("#telefonoPersonal").val(data[0].CELULAR);
            $("#correoProfesional").val(data[0].CORREO);
            $("#colegiatura").val(data[0].colegiatura);
        }
    });
}
$("#updatePassword").submit((e)=>{
    e.preventDefault();
    newPass = $("#contNueva").val();
    conPass = $("#confContra").val();
    if(newPass !== conPass){
        $("#alert-conf").html(`
        <div class="alert alert-danger">Las contraseñas no coinciden!</div>`);
        setTimeout(()=>{
            $("#alert-conf").html(``);
        }, 2000);
    }else{
        $.ajax({
            type: "POST",
            url: '../controllers/personal.controller.php',
            data: $("#updatePassword").serialize() + "&updatePass=true",
            success: function(data, status){
                data = JSON.parse(data);
                if(data.status === "ok"){
                    $("#alert-conf").html(`
                    <div class="alert alert-info">Hecho!</div>`);
                    setTimeout(()=>{
                        $("#alert-conf").html(``);
                    }, 2000);
                }else if(data.status === "err"){
                    if(data.result == 0){
                        $("#alert-conf").html(`
                        <div class="alert alert-danger">Algo salió mal :(</div>`);
                        setTimeout(()=>{
                            $("#alert-conf").html(``);
                        }, 2000);
                    }else{
                        $("#alert-conf").html(`
                        <div class="alert alert-danger">${data.result}</div>`);
                        setTimeout(()=>{
                            $("#alert-conf").html(``);
                        }, 2000);
                    }
                }
            }
          });
    }
});