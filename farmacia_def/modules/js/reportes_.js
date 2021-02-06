$(document).ready(function(){
    listarDiario();
    listarMensual();
});

const listarDiario = ()=>{
    $.ajax({
      type: "POST",
      url: '../controllers/reportes.controller.php',
      data: {diario: "diario"},
      success: function(data, status){ 
        data = JSON.parse(data);
        let dataLoad = ``;
        correlativo = 0;
        for(venta of data){
            correlativo++;
            dataLoad +=`<tr>
                <th>${correlativo}</th>
                <td>${parseFloat(venta.total).toFixed(2)}</td>
                <td>${venta.fecha}</td>
                <td>${venta.hora}</td>
                <td>${venta.nombres}</td>
            </tr>`;
        }
        $("#tablaRepDiario").html(dataLoad);    
      }
    });
  }
  const listarMensual = ()=>{
    $.ajax({
      type: "POST",
      url: '../controllers/reportes.controller.php',
      data: {mensual: "mensual"},
      success: function(data, status){ 
        data = JSON.parse(data);
        let dataLoad = ``;
        correlativo = 0;
        for(venta of data){
            correlativo++;
            dataLoad +=`<tr>
                <th>${correlativo}</th>
                <td>${parseFloat(venta.total).toFixed(2)}</td>
                <td>${venta.fecha}</td>
                <td>${venta.hora}</td>
                <td>${venta.nombres}</td>
            </tr>`;
        }
        $("#tablaRepMensual").html(dataLoad);    
      }
    });
  }