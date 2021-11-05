<?php
namespace app\models\dao;

use app\core\Model;
/**
 * Description of VendaDao
 *
 * @author Fabio soares
 */
class VendaDao extends Model {
    
    public function lista(){
        $sql = "select * from venda v, cliente c where v.id_cliente = c.id_cliente";
        return $this->select($this->db, $sql);
    }
   
    public function getVenda($id_venda){
        $sql = "select * from venda v, cliente c where v.id_cliente = c.id_cliente AND id_venda = $id_venda";
        return $this->select($this->db, $sql, false);
    }
}
