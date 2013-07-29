<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>SISTEMA DE CONTROL DE TRANSPORTE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="expires" content="0" />
    <link type="text/css" href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
    <link type="text/css" href="css/layout.css" rel="stylesheet" />
    <link href="css/cssmenu.css" rel="stylesheet" type="text/css" />
    <link href="css/style_forms.css" rel="stylesheet" type="text/css" />
    <link href="css/ui.jqgrid.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>    
    <script type="text/javascript" src="js/menus.js"></script>
    <script type="text/javascript" src="js/session.js"></script>
    <script type="text/javascript" src="js/required.js"></script>
    <script type="text/javascript" src="js/validateradiobutton.js"></script>
    <script type="text/javascript" src="js/utiles.js"></script>
    <script type="text/javascript" src="js/js-layout.js"></script>
    <script type="text/javascript" src="js/pag.js"></script>
    <script type="text/javascript" src="js/jquery.jqGrid.min.js"></script> 
    <!-- <script type="text/javascript" src="js/jquery.jqGrid.src.js"></script> -->
    <script type="text/javascript" src="js/grid.locale-es.js"></script>
    
</head>
<body>
    <?php 
        //print_r($_SESSION); 
    ?>
    <header id="site_head">
        <div class="header_cont">
            <nav class="head_nav"></nav>
        </div>        
        <div id="barra-session">
            <ul class="item-top">            
                <li>
                    <b><?php echo strtoupper($_SESSION['oficina']) ?></b>
                </li>               
                <li>
                    PERIODO: <?php echo $_SESSION['name_periodo']; ?>
                </li>
                <li>
                    CAJA (<?php echo $_SESSION['name_turno'] ?>): <?php echo $_SESSION['fecha_caja'] ?> 
               </li>            
            </ul>
            <a href="#" class="box-item-notification notification-car-empty" title="Llegada de Vehiculos">
            </a>            
            <a href="#" class="box-item-notification notification-encomienda" title="Encomiendas Pendientes">
                <span class="indicator-notification">2</span>
            </a>
            <a href="#" class="box-item-notification notification-telegiro">
                <span class="indicator-notification">1</span>
            </a>
            <div id="barra-user">                   
                <a href="#" class="login"><?php echo strtoupper($_SESSION['user']); ?></a>
                <a href="index.php?controller=user&action=logout" class="logout">SALIR</a>                
            </div>
        </div>
    </header>
    <div id="body">
         <div id="banner"></div>        
        <div class="spacer"></div>        
        <div id="content">
            <?php echo $content; ?>
        </div>
        <div  class="spacer"></div>
        <div id="foot" class="ui-corner-bottom ui-widget-header">
            CORETEC <br/>2013
        </div>
        <div  class="spacer"></div>        
    </div>
    <div id="dialog-session" title="Su sesión ha expirado." style="display:none">
        <div class="ui-state-error" style="padding: 0 .7em; border: 0">
            <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
            <strong>Por favor vuelva a iniciar sesión.</strong></p>
        </div>
    </div>
    <div id="dialog"></div>
</body>
</html>