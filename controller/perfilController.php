<?php
require_once '../lib/controller.php';
require_once '../lib/view.php';
require_once '../model/perfil.php';
class PerfilController extends Controller
{
    var $cols = array(
                        1 => array('Name'=>'Codigo','NameDB'=>'s.idperfil','align'=>'center','width'=>'20'),
                        2 => array('Name'=>'Descripcion','NameDB'=>'s.descripcion'),
                        3 => array('Name'=>'Estado','NameDB'=>'s.estado','width'=>'30','align'=>'center','color'=>'#FFFFFF')
                     );
   public function index() 
   {
        $data = array();        
        $cols = array();        
        $data['colsNames'] = $this->getColsVal($this->cols);
        $data['colsModels'] = $this->getColsModel($this->cols);        
        $data['controlador'] = "perfil";
        $view = new View();
        $view->setData($data);
        $view->setTemplate('../view/_indexGrid.php');
        $view->setlayout('../template/layout.php');
        $view->render();
    }
    public function indexGrid() 
    {
        $obj = new Perfil();
        $page = (int)$_GET['page'];
        $limit = (int)$_GET['rows']; 
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];
        if(!$sidx) $sidx = 1;
        if(!$limit) $limit = 10;
        if(!$page) $page = 1;
        echo json_encode($obj->indexGrid($page,$limit,$sidx,$sord));
    }
    public function create()
    {
        $data = array();
        $view = new View();        
        $data['more_options'] = $this->more_options('Perfil');
        $view->setData($data);
        $view->setTemplate( '../view/perfil/_form.php' );        
        $view->setlayout( '../template/layout.php' );
        $view->render();
    }
    public function edit() {
        $obj = new Perfil();
        $data = array();
        $data['more_options'] = $this->more_options('Perfil');
        $view = new View();
        $obj = $obj->edit($_GET['id']);
        $data['obj'] = $obj;      
        $view->setData($data);
        $view->setTemplate( '../view/perfil/_form.php' );
        $view->setlayout( '../template/layout.php' );
        
        $view->render();
    }
   public function save()
   {
        $obj = new Perfil();
        if ($_POST['idperfil']=='') {
            $p = $obj->insert($_POST);
            if ($p[0]){
                header('Location: index.php?controller=perfil');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=perfil';
            $view->setData($data);
            $view->setTemplate( '../view/_error_app.php' );
            $view->setlayout( '../template/layout.php' );
            $view->render();
            }
        } else {
            $p = $obj->update($_POST);
            if ($p[0]){
                header('Location: index.php?controller=perfil');
            } else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=perfil';
            $view->setData($data);
            $view->setTemplate( '../view/_error_app.php' );
            $view->setlayout( '../template/layout.php' );
            $view->render();
            }
        }
    }
    public function delete()
      {
        $obj = new Perfil();
        $p = $obj->delete($_GET['id']);
        if ($p[0]){
            header('Location: index.php?controller=perfil');
        } 
        else {
            $data = array();
            $view = new View();
            $data['msg'] = $p[1];
            $data['url'] =  'index.php?controller=perfil';
            $view->setData($data);
            $view->setTemplate( '../view/_error_app.php' );
            $view->setlayout( '../template/layout.php' );
            $view->render();
        }
      }
   
   
}
?>