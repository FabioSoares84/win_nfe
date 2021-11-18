<?php
namespace app\models\service;

use app\models\dao\ProdutoDao;
use app\models\validacao\TributacaoValidacao;

class TributacaoService{

    public static function salvar($tributacao, $campo , $tabela){
        $validacao = TributacaoValidacao::salvar($tributacao);
        return Service::salvar($tributacao, $campo, $validacao->listaErros(), $tabela);
    }
    

}