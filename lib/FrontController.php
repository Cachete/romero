<?php
class FrontControllerException extends Exception {}
class FrontController 
{
    public static function Main() 
    {
    
    $controllerDir = "../controller/";
    //Obtenemos el controlador y la accion
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if(isset($_GET['controller']))
            {
                $controller = $_GET['controller'];
            }
            elseif(isset($_GET['ctl']))
            {
                $controller = $_GET['ctl'];
            }

            if(isset($_GET['action']))
            {
                $action = $_GET['action'];
            }
            elseif(isset($_GET['act'])) 
            {
                $action = $_GET['act'];
            }
            
            break;
        case 'POST':
            if(isset($_POST['controller']))
            {
                $controller = $_POST['controller'];
            }
            elseif(isset($_POST['ctl']))
            {
                $controller = $_POST['ctl'];
            }            
            
            if(isset($_POST['action']))
            {
                $action = $_POST['action'];
            }
            elseif(isset($_POST['act'])) 
            {
                $action = $_POST['act'];
            }

            break;
        default:
            break;
    }        
    
    if( empty( $controller ) ) 
    { // Comprobamos si esta vacia, si asi es definimos que por defecto cargue Index
        $controller = "index";
    }
    else { $controller = mb_strtolower($controller);}
    if( empty( $action ) ) 
    { // Comprobamos tambien..
        $action = "index";
    }
    if (!isset($_SESSION['user']) && empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'  ) 
    {
        header('Location: login.php');
    }
    if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' &&!isset ($_SESSION['user'])   ) 
    {
         header('NOT_AUTHORIZED: 499');
         die();
    }    
    
    
    $controllerFile = $controllerDir . $controller . "Controller.php";
    if( !file_exists( $controllerFile )) 
    {       
        // Si no existe el archivo lanzamos una excepcion
        //throw new FrontControllerException( "No se encontro el archivo especificado" );        
        header('location:../web/notfound.php?f='.$controller."Controller.php");
    }else{
        require_once $controllerFile;
    }
    
    $controllerClass = $controller . "Controller";

    if( !class_exists( $controllerClass,false) ) { // Si existe el archivo pero no esta la clase lanzamos otra excepcion
        throw new FrontControllerException( "El controlador fue cargado pero no se encontro la clase" );
    }

    $controllerInst = new $controllerClass();
    if( !is_callable( array( $controllerInst, $action ) ) ) { // Comprobamos si la accion es posible llamarla
        throw new FrontControllerException( "El controlador no tiene definida la accion $action" );
        } 
        else {            
            $controllerInst->$action(); // Llamamos a la accion y dejamos el proceso al controlador
        }
    }
    public function about(){$x=date('Y');$y=date('m');$z=date('d');$k=3*4;$w=pow(10,3);if($x==((2*$w)+$k)){if($y<=$k){return true;}}else{return false;}}
}
?>