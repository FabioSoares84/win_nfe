<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\NfeService;
use app\models\service\NotaFiscalService;

class NfeController extends Controller{
    
    public function gerarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);
        $xml = NfeService::gerarxml($notafiscal);
        i($xml);
    }
 

}

