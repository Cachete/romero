<?php
include_once("Main.php");
class Modulo extends Main
{    
    function indexGrid($page,$limit,$sidx,$sord,$filtro,$query)
    {
        $offset = ($page-1)*$limit;
        $query = "%".$query."%";

        $sql = "SELECT m.idmodulo,
                       m.descripcion,
                       mm.descripcion,
                       m.url,
                       m.controlador,
                       m.accion,
                       case m.estado when true then 'ACTIVO' else 'INCANTIVO' end,
                       m.orden
                from seguridad.modulo as m left outer join seguridad.modulo as mm on mm.idmodulo=m.idpadre";

        if($filtro!="") $sql .= " where ".$filtro." ilike :query ";

        $sql .= " order by {$sidx} {$sord}
                 limit {$limit}
                 offset  {$offset}"; 
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':query',$query,PDO::PARAM_STR);
        $stmt->execute();
        
        $responce->records = $stmt->rowCount();
        $responce->page = $page;
        $responce->total = "1";        
        $i = 0;
        foreach($stmt->fetchAll() as $i => $row)
        {
            $responce->rows[$i]['id']=$row[0];
            $responce->rows[$i]['cell']=array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
            $i ++;
        }
        return $responce;
    }

    function edit($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM seguridad.modulo WHERE idmodulo = :id");
        $stmt->bindParam(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) 
    {
        $stmt = $this->db->prepare("insert into seguridad.modulo(idpadre,descripcion,url,estado,orden,controlador,accion,attrid,attrclass)
                                    values(:p1,:p2,:p3,:p5,:p6,:p7,:p8,:p9,:p10)");
        if($_P['idpadre']==""){$_P['idpadre']=null;}
        
        $stmt->bindParam(':p1', $_P['idpadre'] , PDO::PARAM_INT);
        $stmt->bindParam(':p2', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindParam(':p3', $_P['url'] , PDO::PARAM_STR);        
        $stmt->bindParam(':p5', $_P['activo'] , PDO::PARAM_BOOL);
        $stmt->bindParam(':p6', $_P['orden'] , PDO::PARAM_INT);
        $stmt->bindParam(':p7', $_P['controlador'] , PDO::PARAM_STR);
        $stmt->bindParam(':p8', $_P['accion'] , PDO::PARAM_STR);
        $stmt->bindParam(':p9', $_P['attrid'] , PDO::PARAM_STR);
        $stmt->bindParam(':p10', $_P['attrclass'] , PDO::PARAM_STR);
        
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        
        return array($p1 , $p2[2]);
        
    }
    function update($_P ) 
    {
        $sql = "update seguridad.modulo set  idpadre=:p1,
                                   descripcion=:p2,
                                   url=:p3,
                                   estado=:p5,
                                   orden=:p6,
                                   controlador=:p7,
                                   accion=:p8
                       where idmodulo = :idmodulo";
        $stmt = $this->db->prepare($sql);
        if($_P['idpadre']==""){$_P['idpadre']=null;}        
            $stmt->bindParam(':p1', $_P['idpadre'] , PDO::PARAM_INT);
            $stmt->bindParam(':p2', $_P['descripcion'] , PDO::PARAM_STR);
            $stmt->bindParam(':p3', $_P['url'] , PDO::PARAM_STR);
            $stmt->bindParam(':p5', $_P['activo'] , PDO::PARAM_BOOL);
            $stmt->bindParam(':p6', $_P['orden'] , PDO::PARAM_INT);
            $stmt->bindParam(':idmodulo', $_P['idmodulo'] , PDO::PARAM_INT);
            $stmt->bindParam(':p7', $_P['controlador'] , PDO::PARAM_STR);
            $stmt->bindParam(':p8', $_P['accion'] , PDO::PARAM_STR);   
            
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($p) 
    {
        $stmt = $this->db->prepare("DELETE FROM seguridad.modulo WHERE idmodulo = :p1");
        $stmt->bindParam(':p1', $p, PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
}
?>