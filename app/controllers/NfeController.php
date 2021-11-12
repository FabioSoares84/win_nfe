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
    
    public function assinarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::assinarXml($notafiscal);
        i($xml);
    }
    
    public function enviarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::enviarXml($notafiscal);
        i($xml);
    }
    
    public function autorizarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::autorizaXml($notafiscal);
        i($xml);
    }
    
    public function gerarDanfe($id_nfe){
       echo "gerarDanfe";
    }
    
 

}

