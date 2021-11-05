<?php

namespace app\models\dao;

use app\core\Model;
/**
 * Description of ProdutoDao
 *
 * @author Fabio soares
 */
class ProdutoDao extends Model {
    
    public function lista(){
        $sql = "select * from produto p, unidade u where p.id_unidade = u.id_unidade";
        return $this->select($this->db, $sql);
    }
   
    public function getProduto($id_produto){
        $sql = "select * from produto p, unidade u where p.id_unidade = u.id_unidade AND id_produto = $id_produto";
        return $this->select($this->db, $sql, false);
    }
}
