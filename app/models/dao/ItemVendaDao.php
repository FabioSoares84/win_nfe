<?php
namespace app\models\dao;

use app\core\Model;
/**
 * Description of VendaDao
 *
 * @author Fabio soares
 */
class ItemVendaDao extends Model {
    
    public function listaPorVenda($id_venda){
        $sql = "select * from item_venda i, produto p, unidade u WHERE i.id_produto = p.id_produto AND p.id_unidade = u.id_unidade AND i.id_venda = $id_venda";
        return $this->select($this->db, $sql);
    }
   

}
