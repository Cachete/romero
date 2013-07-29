<?php
include_once("Main.php");
class Perfil extends Main
{
    function indexGrid($page,$limit,$sidx,$sord)
    {
        $offset = ($page-1)*$limit;
        $query = "%".$query."%";

        $sql = "SELECT s.idperfil,
                       s.descripcion,
                       case s.estado when true then 'ACTIVO' else 'INCANTIVO' end
                from seguridad.perfil as s  where s.descripcion like :query                                
                order by {$sidx} {$sord}
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
            $responce->rows[$i]['cell']=array($row[0],$row[1],$row[2]);
            $i ++;
        }
        return $responce;
    }
    function edit($id ) {
        $stmt = $this->db->prepare("SELECT * FROM perfil WHERE idperfil = :id");
        $stmt->bindParam(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
    function insert($_P ) {
        $stmt = $this->db->prepare("insert into perfil (descripcion, estado) values(:p1,:p2)");
        $stmt->bindParam(':p1', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindParam(':p2', $_P['activo'] , PDO::PARAM_BOOL);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function update($_P ) {
        $stmt = $this->db->prepare("update perfil set descripcion = :p1, estado = :p2 where idperfil = :idperfil");
        $stmt->bindParam(':p1', $_P['descripcion'] , PDO::PARAM_STR);
        $stmt->bindParam(':p2', $_P['activo'] , PDO::PARAM_BOOL);
        $stmt->bindParam(':idperfil', $_P['idperfil'] , PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
    function delete($_P ) {
        $stmt = $this->db->prepare("DELETE FROM perfil WHERE idperfil = :p1");
        $stmt->bindParam(':p1', $_P , PDO::PARAM_INT);
        $p1 = $stmt->execute();
        $p2 = $stmt->errorInfo();
        return array($p1 , $p2[2]);
    }
}
?>