<?php
namespace app\models\service;

use app\models\validacao\EmitenteValidacao;

class EmitenteService{

    public static function salvar($emitente, $campo , $tabela){
        $validacao = EmitenteValidacao::salvar($emitente);
        return Service::salvar($emitente, $campo, $validacao->listaErros(), $tabela);
    }

}