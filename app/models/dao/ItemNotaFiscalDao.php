<?php
namespace app\models\dao;

use app\core\Model;
/**
 * Description of VendaDao
 *
 * @author Fabio soares
 */
class ItemNotaFiscalDao extends Model {
    
    public function existeItem($id_nfe,$id_produto){
        $sql = "select * from nfe_item WHERE cProd = $id_produto AND id_nfe = $id_nfe";
        return $this->select($this->db, $sql, false);
    }
   

}
