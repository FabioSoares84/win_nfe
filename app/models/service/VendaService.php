<?php
namespace app\models\service;

use app\models\dao\VendaDao;

class VendaService{

    public static function lista(){
        $dao = new VendaDao();
        return $dao->lista();
    }
    
    public static function getVenda($id_venda){
        $dao = new VendaDao();
        return $dao->getVenda($id_venda);
    }
    
    public static function atualizarVenda($id_venda){
        $total = Service::getSoma("item_venda","subtotal","id_venda",$id_venda);
        Service::editar(["total"=>$total, "id_venda"=>$id_venda], "id_venda", "venda");
    }

}