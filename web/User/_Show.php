<?php
    include("../view/functions.php");
?>
<script type="text/javascript" src="js/app/evt_form_modulo.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>

<div class="div_container">
<h6 class="ui-widget-header">Informacion de Perfiles</h6>
<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="Perfil" />
    <input type="hidden" name="action" value="delete" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div style="margin:0 auto; width: 600px; ">
                <label for="idperfil" class="labels">Codigo:</label>
                <input id="idperfil" name="idperfil" class="text ui-widget-content ui-corner-all" style=" width: 200px; text-align: left;" value="<?php echo $obj->idperfil; ?>" readonly />
                <br/>
                <label for="descripcion" class="labels">Descripcion:</label>
                <input id="descripcion" maxlength="100" name="descripcion" class="text ui-widget-content ui-corner-all" style=" width: 200px; text-align: left;" value="<?php echo $obj->descripcion; ?>" readonly="readonly" />
                <br>
                <label for="estado" class="labels">Activo:</label>
                <?php
                    $item = array("Si","No");
                    if($obj->estado!="")
                            {$rep = $obj->estado;  }
                      else {$rep = 1;  }

                    printRadios2('activo',$item,$rep);
                ?>

                <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="delete" class="button">ELIMINAR</a>
                    <a href="index.php?controller=Perfil" class="button">ATRAS</a>
                </div>
        </div>
    </div>
</form>
</div>