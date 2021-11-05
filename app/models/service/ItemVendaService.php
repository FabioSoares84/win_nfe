<?php
namespace app\models\service;


use app\models\dao\ItemVendaDao;
use app\models\validacao\ItemVendaValidacao;

class ItemVendaService{
    
    public static function salvar($cliente,$campo,$tabela){
        $validacao = ItemVendaValidacao::salvar($cliente);
        return Service::salvar($cliente, $campo, $validacao->listaErros(), $tabela);
        
    }
    
    public static function ListaPorVenda($id_venda){
        $dao = new ItemVendaDao();
        return $dao->listaPorVenda($id_venda);
    }
    
   

}