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
        $xml = NFeService::assinarXml($notafiscal);
        i($xml);
    }
    
    public function enviarXml($id_nfe){
       echo "enviarXml";
    }
    
    public function autorizarXml($id_nfe){
       echo "autorizarXml"; 
    }
    
    public function gerarDanfe($id_nfe){
       echo "gerarDanfe";
    }
    
 

}

