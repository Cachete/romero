$(function() {
    $("#div_activo").buttonset();
    $( "#save" ).click(function(){
        bval = true;
        bval = bval && $( "#descripcion" ).required();
        if ( bval ) {
            $("#frm").submit();
        }
        return false;
    });

    $( "#delete" ).click(function(){
          if(confirm("Confirmar Eliminacion de Registro"))
              {
                  $("#frm").submit();
              }
    });
});