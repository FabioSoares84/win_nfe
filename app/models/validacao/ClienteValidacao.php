<?php
namespace app\models\validacao;

use app\core\Validacao;

class ClienteValidacao{
    public static function salvar($cliente){
        $validacao = new Validacao();
        $validacao->setData("cliente",$cliente->nome);
        $validacao->setData("cliente",$cliente->cnpj);
        
        //fazendo a validacao
        $validacao->getData("nome")->isVazio();
        $validacao->getData("cnpj")->isCNPJ();
        return $validacao;
    }
    
}