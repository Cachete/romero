<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("Main.php");
class personal extends Main {

    function getpersonal($id)
    {
        $stmt = $this->db->prepare("select idempleado,concat(empleado.nombres,' ',empleado.apellidos) as nombres 
                                    from empleado where idempleado = ? ");
        $stmt->bindParam(1,$id,PDO::PARAM_STR);
        $stmt->execute();
        $obj = $stmt->fetchObject();
        return $obj;
        
    }

    function save_change_passw($pw,$id)
    {
       if($id==$_SESSION['idempleado'])
        {
           $stmt = $this->db->prepare("update empleado set clave = ? where idempleado = ?");
           $stmt->bindParam(1,$pw,PDO::PARAM_STR);
           $stmt->bindParam(2,$id,PDO::PARAM_STR);
           $r = $stmt->execute();
           return $r;
        } 
        else 
        {
           return false;
        }
    }
    
    function index($query , $p ,$c) {
        $sql = "SELECT empleado.idempleado,                        
                       concat(empleado.nombre,' ',empleado.apellidos) as nombres,
                       concat(o.descripcion,' (',s.descripcion,') '),
                        case empleado.turno when 1 then '<p style=\"color:green\">NORMAL</p>' else '<p style=\"color:red\">GUARDIANIA</p>' end,
                       case empleado.estado when 1 then '<p style=\"color:green\">ACTIVO</p>' else '<p style=\"color:red\">INACTIVO</p>' end                       
                    FROM tipo_empleado as te inner join empleado on te.idtipo_empleado = empleado.idtipo_empleado
                            inner join oficina as o on o.idoficina = empleado.idoficina
                            inner join sucursal as s on s.idsucursal = o.idsucursal
             where {$c} like :query and empleado.idtipo_empleado = 1
             order by empleado.nombre, empleado.apellidos";
             
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );
        $data['rowspag'] =  $this->getRowPag($data['total'], $p );
        return $data;
    }
    
    function edit($id ) {
        $stmt = $this->db->prepare("SELECT * FROM empleado WHERE idempleado = :id");
        $stmt->bindParam(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) 
    {
        $idempleado = 1;
        
        $stmt = $this->db->prepare('insert into empleado (  idempleado,
                                                            idtipo_empleado,
                                                            idoficina,
                                                            nombre,
                                                            apellidos,
                                                            ruc,
                                                            fecha_nacimiento,
                                                            estado,
                                                            celular,
                                                            fecha_registro,
                                                            turno)
                                    values(:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10,:p11)');
        $stmt->bindParam(':p1', $_P['idempleado'] , PDO::PARAM_STR);
        $stmt->bindParam(':p2', $idempleado , PDO::PARAM_INT);
        $stmt->bindParam(':p3', $_P['idoficina'] , PDO::PARAM_INT);
        $stmt->bindParam(':p4', $_P['nombre'] , PDO::PARAM_STR);
        $stmt->bindParam(':p5', $_P['apellidos'] , PDO::PARAM_STR);
        $stmt->bindParam(':p6', $_P['ruc'] , PDO::PARAM_STR);        
        $stmt->bindParam(':p7', $this->fdate($_P['fecha_nacimiento'],'EN') , PDO::PARAM_STR);
        $stmt->bindParam(':p8', $_P['activo'] , PDO::PARAM_BOOL);
        $stmt->bindParam(':p9', $_P['celular'] , PDO::PARAM_STR);
        $stmt->bindParam(':p10', $this->fdate($_P['fecha_registro'],'EN') , PDO::PARAM_STR);
        $stmt->bindParam(':p11', $_P['turno'] , PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    
    function update($_P ) 
    {        
        $stmt = $this->db->prepare('UPDATE empleado
                                   SET  idoficina=:p1,
                                        nombre=:p2,
                                        apellidos=:p3, 
                                        ruc=:p4,
                                        fecha_nacimiento=:p5,
                                        estado=:p6,
                                        celular=:p7,
                                        fecha_registro=:p8,
                                        turno=:p9
                                 WHERE idempleado = :idempleado');       
        $stmt->bindParam(':p1', $_P['idoficina'] , PDO::PARAM_INT);
        $stmt->bindParam(':p2', $_P['nombre'] , PDO::PARAM_STR);
        $stmt->bindParam(':p3', $_P['apellidos'] , PDO::PARAM_STR);
        $stmt->bindParam(':p4', $_P['ruc'] , PDO::PARAM_STR);        
        $stmt->bindParam(':p5', $this->fdate($_P['fecha_nacimiento'],'EN') , PDO::PARAM_STR);
        $stmt->bindParam(':p6', $_P['activo'] , PDO::PARAM_BOOL);
        $stmt->bindParam(':p7', $_P['celular'] , PDO::PARAM_STR);
        $stmt->bindParam(':p8', $this->fdate($_P['fecha_registro'],'EN') , PDO::PARAM_STR);
        $stmt->bindParam(':p9', $_P['turno'] , PDO::PARAM_INT);
        $stmt->bindParam(':idempleado', $_P['idempleado'] , PDO::PARAM_STR);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
//    function delete($_P ) {
//        $stmt = $this->db->prepare("DELETE FROM perfil WHERE idperfil = :p1");
//        $stmt->bindParam(':p1', $_P['idperfil'] , PDO::PARAM_STR);
//        $p1 = $stmt->execute();
//        $p2 = $stmt->errorInfo();
//        return array($p1 , $p2[2]);
//    }
    function getchofer($query,$field)
    {
        $query = "%".$query."%";
        $statement = $this->db->prepare("SELECT idempleado, 
                                                concat(nombre,' ',apellidos) as nombre,
                                                aleas
                                         FROM empleado
                                         WHERE {$field} like :query and idtipo_empleado = 2
                                         limit 10");
        $statement->bindParam (":query", $query , PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }
}
?>