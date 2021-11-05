<?php
namespace app\models\validacao;

use app\core\Validacao;

class ProdutoValidacao{
    public static function salvar($produto){
        $validacao = new Validacao();
        $validacao->setData("produto",$produto->produto);
        $validacao->setData("produto",$produto->preco);
        
        //fazendo a validacao
        $validacao->getData("produto")->isVazio();
        $validacao->getData("preco")->isCNPJ();
        return $validacao;
    }
    
}