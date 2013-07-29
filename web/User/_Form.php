<?php
    include("../view/functions.php");
?>
<script type="text/javascript" src="js/app/evt_form_User.js" ></script>
<script type="text/javascript" src="js/validateradiobutton.js"></script>
<?php 
    $readonly = "";
    if($obj->idusuario!="")
        {
            $readonly="readonly";
        }
?>
<div class="div_container">
<h6 class="ui-widget-header">Registro de Usuario</h6>
<form id="frm" action="index.php" method="POST">
    <input type="hidden" name="controller" value="User" />
    <input type="hidden" name="action" value="save" />
    <div class="contFrm ui-corner-all" style="background: #fff;">
        <div style="margin:0 auto; width: 600px;">                
                <label for="idusuario" class="labels">DNI:</label>
                <input id="idusuario" name="idusuario" class="text ui-widget-content ui-corner-all" style=" width: 200px; text-align: left;" value="<?php echo $obj->idusuario; ?>" <?php echo $readonly; ?> />
                <label for="idperfil" class="labels">Perfil:</label>
                <?php echo $perfil; ?>
                <br/>
                <label for="nombres" class="labels">Nombres:</label>
                <input id="nombres" maxlength="100" name="nombres" class="text ui-widget-content ui-corner-all" style=" width: 200px; text-align: left;" value="<?php echo $obj->nombres; ?>" />
                <label for="nombres" class="labels">Apellidos:</label>
                <input id="apellidos" maxlength="100" name="apellidos" class="text ui-widget-content ui-corner-all" style=" width: 200px; text-align: left;" value="<?php echo $obj->apellidos; ?>" />
                <br/>
                <label for="login" class="labels">Login:</label>
                <input id="login" maxlength="100" name="login" class="text ui-widget-content ui-corner-all" style=" width: 200px; text-align: left;" value="<?php echo $obj->login; ?>" />
                <label for="password" class="labels">Password:</label>
                <input id="password" maxlength="100" name="password" type="password" class="text ui-widget-content ui-corner-all" style=" width: 200px; text-align: left;" value="<?php echo $obj->clave; ?>" />
                <br/>
                <label for="celular" class="labels">Celular:</label>
                <input id="celular" maxlength="100" name="celular" class="text ui-widget-content ui-corner-all" style=" width: 200px; text-align: left;" value="<?php echo $obj->login; ?>" />
                <?php if($obj->idusuario!="") { $op = 1;} else {$op=0;}?>
                <input type="hidden" name="oper" id="oper" value="<?php echo $op; ?>"/>
                <label for="estado" class="labels">Activo:</label>                
                <?php
                    
                    $item = array("Si","No");
                    if($obj->estado!="")
                            {$rep = $obj->estado;  }
                      else {$rep = 2;  }
                                      
                    printRadios2('activo',$item,$rep);
                ?>
                <div  style="clear: both; padding: 10px; width: auto;text-align: center">
                    <a href="#" id="save" class="button">GRABAR</a>
                    <a href="index.php?controller=User" class="button">ATRAS</a>
                </div>
        </div>
    </div>
</form>
</div>