<?php
namespace app\models\validacao;

use app\core\Validacao;

class TributacaoValidacao{
    public static function salvar($tributacao){
        $validacao = new Validacao();
        $validacao->setData("tributacao",$tributacao->tributacao);
        
        //fazendo a validacao
        $validacao->getData("tributacao")->isVazio();
        return $validacao;
    }
    
}