$(document).ready(function() {
  $("#alertAdd").hide();
  $("#CamposVacios").hide();
  // gestion formulario add Usuario
    $("#addUsers").submit(function(e){
      let datos = $("#addUsers").serialize();
      $.post("backend/Add-Users.php", datos ,function(response) {
          if (response == 1) {
              
            bootbox.alert({
                title: "Mensaje Confirmacion",
                message: `<center><h3><img src="icon/Checkmark.png" alt=""> Usuario Ha sido Agregado con Exito</h3></center>`
            });
            $("#alertAdd").hide();
          }else{
            $("#alertAdd").show();
            $("#CamposVaciosAdd").html(response);
          }
          $("#addUsers").trigger("reset");
         
      });
      e.preventDefault();
      
    });
  
    // gestion formulario login
    $("#FormValidate").submit(function(e) {

      let DatosValidate = {
        usuario: $("#usuario").val(),
        clave: $("#clave").val()
      };
      // console.log(DatosValidate);
      $.post("backend/log-user.php", DatosValidate ,function(response) {
        let esJson = isJSONString(response);
        if (esJson) {
          let DataUsuario = JSON.parse(response);
          console.log(DataUsuario);
          bootbox.alert({
            title: "DATOS DEL USUARIO",
            message: `
            Nombre: ${DataUsuario[0].nombre}<br>
            <hr>
            Apellido: ${DataUsuario[0].apellido}<br>
            <hr>
            Usuario: ${DataUsuario[0].usuario}<br>
            <hr>
            Password: ${DataUsuario[0].pass}<br>
            <hr>
            Sexo: ${DataUsuario[0].sexo}<br>
            <hr>
            Pais: ${DataUsuario[0].pais}<br>
            <hr>
            Status: ${DataUsuario[0].estado}<br>
            
            
            
            `
          });
            
          $("#CamposVacios").hide();

        }else{

          $("#CamposVacios").html(response);
          $("#CamposVacios").show();
          
        }
        // console.log(response);
      });
      $("#FormValidate").trigger("reset");
      e.preventDefault();
    });

  function isJSONString(datos) {
    try {
      JSON.parse(datos);
    } catch (e) {
      return false;
    }
    return true;
  }





});