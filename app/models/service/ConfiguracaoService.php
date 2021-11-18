<?php
namespace app\models\service;

use app\models\validacao\ProdutoValidacao;
use app\models\dao\ProdutoDao;

class ConfiguracaoService{

    public static function salvar($configuracao, $campo , $tabela){
        $validacao = ProdutoValidacao::salvar($configuracao);
        return Service::salvar($configuracao, $campo, $validacao->listaErros(), $tabela);
    }
    
    public static function lista(){
        $dao = new ProdutoDao();
        return $dao->lista();
    }
    
    public static function getProduto($id_produto){
        $dao = new ProdutoDao();
        return $dao->getProduto($id_produto);
    }

}