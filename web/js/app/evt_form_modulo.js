$(function() 
{    
    $( "#idpadre" ).focus();
    $( "#idpadre" ).css({'width':'210px'});
    $("#div_activo").buttonset();
    $( "#delete" ).click(function(){
          if(confirm("Confirmar Eliminacion de Registro"))
              {
                  $("#frm").submit();
              }
    });
});
function save()
{
  bval = true;        
  bval = bval && $( "#descripcion" ).required();        
  bval = bval && $( "#orden" ).required();
  bval = bval && $("#div_activo").validateradiobutton();
  var str = $("#frm").serialize();

  if ( bval ) 
  {
      $.post('index.php',str,function(res)
      {
        //alert(res);
        $("#box-frm").dialog("close");
        gridReload();
      });
  }
  return false;
}