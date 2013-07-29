<?php
require_once '../lib/controller.php';
require_once '../lib/view.php';
require_once '../model/modulo.php';

class ModuloController extends Controller 
{   
    var $cols = array(
                        1 => array('Name'=>'Codigo','NameDB'=>'m.idmodulo','align'=>'center','width'=>50),
                        2 => array('Name'=>'Descripcion','NameDB'=>'m.descripcion','width'=>250,'search'=>true),
                        3 => array('Name'=>'Principal','NameDB'=>'mm.descripcion','search'=>true),
                        4 => array('Name'=>'URL Link','NameDB'=>'m.url'),
                        5 => array('Name'=>'Controlador','NameDB'=>'m.url'),
                        6 => array('Name'=>'Accion','NameDB'=>'m.controlador','width'=>70),
                        7 => array('Name'=>'Estado','NameDB'=>'m.estado','align'=>'center','width'=>70),
                        8 => array('Name'=>'Orden','NameDB'=>'m.orden','align'=>'center','width'=>'50')
                     );
    public function index() 
    {        
        $data = array();                               
        $data['colsNames'] = $this->getColsVal($this->cols);
        $data['colsModels'] = $this->getColsModel($this->cols);        
        $data['cmb_search'] = $this->Select(array('id'=>'fltr','name'=>'fltr','text_null'=>'','table'=>$this->getColsSearch($this->cols)));
        $data['controlador'] = $_GET['controller'];
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/_indexGrid.php');
        $view->setlayout('../template/layout.php');
        $view->render();
    }
    public function indexGrid() 
    {
        $obj = new Modulo();        
        $page = (int)$_GET['page'];
        $limit = (int)$_GET['rows']; 
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];                
        $filtro = $this->getColNameDB($this->cols,(int)$_GET['f']);        
        $query = $_GET['q'];
        if(!$sidx) $sidx = 1;
        if(!$limit) $limit = 10;
        if(!$page) $page = 1;
        echo json_encode($obj->indexGrid($page,$limit,$sidx,$sord,$filtro,$query));
    }
    public function create() 
    {
        $data = array();
        $view = new View();
        $data['ModulosPadres'] = $this->Select(array('id'=>'idpadre','name'=>'idpadre','table'=>'vista_modulo'));
        $data['more_options'] = $this->more_options('Modulo');
        $view->setData($data);
        $view->setTemplate( '../view/modulo/_form.php' );
        echo $view->renderPartial();
    }
    public function edit() {
        $obj = new Modulo();
        $data = array();
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;
        $data['ModulosPadres'] = $this->Select(array('id'=>'idpadre','name'=>'idpadre','table'=>'seguridad.vista_modulo','code'=>$obj->idpadre));
        $data['more_options'] = $this->more_options('Modulo');
        $view->setData($data);
        $view->setTemplate( '../view/modulo/_form.php' );
        echo $view->renderPartial();
    }
    public function save()
    {

        $obj = new Modulo();

        $result = array();
        
        if ($_POST['idmodulo']=='') 
        {
            $p = $obj->insert($_POST);
            
                if ($p['res']=='1')                
                    $result = array(1,'',$p['ide'],$p['ce']);                
                else                 
                    $result = array(2,$p['msg'],'');
                print_r(json_encode($result));           
        }
        else 
        {
            $p = $obj->update($_POST);            
            if ($p[0])                
                $result = array(1,'',$p['ide']);                
            else                 
                $result = array(2,$p[1],'');
            print_r(json_encode($result));    
        }

    }
    public function delete(){
        $obj = new Modulo();
        $p = $obj->delete($_GET['id']);
        if ($p[0]){
            header('Location: index.php?controller=modulo');
        } else {
        $data = array();
        $view = new View();
        $data['msg'] = $p[1];
        $data['url'] =  'index.php?controller=modulo';
        $view->setData($data);
        $view->setTemplate( '../view/_error_app.php' );
        $view->setlayout( '../template/layout.php' );
        $view->render();
        }
    }
 
}
?>