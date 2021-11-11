<?php
namespace app\models\dao;

use app\core\Model;
/**
 * Description of VendaDao
 *
 * @author Fabio soares
 */
class NotaFiscalDao extends Model {
    
    public function lista(){
        $sql = "SELECT * FROM nfe n, nfe_destinatario d where n.id_nfe = d.id_nfe";
        return $this->select($this->db, $sql);
    }
    
    public function getNotaEmDigitacao(){
        $sql = "SELECT * FROM nfe n, nfe_emitente e WHERE n.id_nfe and id_status = 1";
        return $this->select($this->db, $sql, false);
    }
   
    
    public function getNotaFiscal($id_nfe){
        $sql = "SELECT * FROM nfe WHERE id_nfe = $id_nfe";
        return $this->select($this->db, $sql, false);
    }
    
    public function salvarChave($id_nfe, $chave){
        $sql = "UPDATE nfe SET chave='$chave', id_status=2 WHERE id_nfe = $id_nfe";
        return $this->db->query($sql);
    }
   
     public function mudarStatus($id_nfe, $id_status){
        $sql = "UPDATE nfe SET id_status=$id_status WHERE id_nfe = $id_nfe";
        return $this->db->query($sql);
    }

}
