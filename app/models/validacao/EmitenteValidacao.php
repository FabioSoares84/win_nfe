<?php
namespace app\models\validacao;

use app\core\Validacao;

class EmitenteValidacao{
    public static function salvar($emitente){
        $validacao = new Validacao();
        $validacao->setData("emitente",$emitente->razao_social);
        $validacao->setData("emitente",$emitente->cnpj);
        
        //fazendo a validacao
        $validacao->getData("razao_social")->isVazio();
        $validacao->getData("cnpj")->isCNPJ();
        return $validacao;
    }
    
}