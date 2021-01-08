$(document).ready(()=>{
});
$("#mainForm").on("submit", (e)=>{
    e.preventDefault();
    validarInfo();
});

const validarInfo = (e)=>{
        let data = $("#mainForm").serialize();
        $.ajax({
            type: "POST",
            url: './modules/login/controllers/controller.php',
            data: data,
            success: function(data, status){ 
                console.log(data);
                data = JSON.parse(data);
                if(data == 1){
                    //dirijimos a admision
                    location.href = "./modules/admin/views/reportes.php";
                }else if(data == 2){
                    //dirijimos a perfil de profesional
                    location.href = "./modules/vendedor/views/vendedor.php";
                }else if(data == "err"){
                    $("#userIncorrecto").html(`
                        <div class="alert alert-danger" role="alert">
                            Usuario o contraseña incorrectos
                        </div>
                    `);
                    setTimeout(()=>{
                        $("#userIncorrecto").html('');
                    }, 2000);
                }
            }
          });

}