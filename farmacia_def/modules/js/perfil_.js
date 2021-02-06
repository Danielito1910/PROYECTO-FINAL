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
                console.log(data);
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