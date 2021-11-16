<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\NfeService;
use app\models\service\NotaFiscalService;
use app\core\Flash;

class NfeController extends Controller{
    
    public function gerarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);
        $xml = NfeService::gerarxml($notafiscal);
        
        $erro = ($xml->erro > 0) ? -1 : 1;
        Flash::setMsg($xml->msg .":". $xml->msg_erro, $erro);
      
        $this->redirect(URL_BASE."notafiscal");
    }
    
    public function assinarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::assinarXml($notafiscal);
        
        if($xml->erro > 0){
            Flash::setMsg($xml->msg .":". $xml->msg_erro, -1);
        }
        
        $this->redirect(URL_BASE."notafiscal");
    }
    
    public function enviarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::enviarXml($notafiscal);
        $this->redirect(URL_BASE."notafiscal");
    }
    
    public function autorizarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::autorizaXml($notafiscal);
        $this->redirect(URL_BASE."notafiscal");
    }
    
    public function cancelarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::cancelarNfe($notafiscal);
        
        $erro = ($xml->erro > 0) ? -1 : 1;
        Flash::setMsg($xml->msg .":". $xml->msg_erro, $erro);
        
        $this->redirect(URL_BASE."notafiscal");
    }
    
    
    public function consultarNfe($id_nfe) {
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::consultarNfe($notafiscal);
        
        $erro = ($xml->erro > 0) ? -1 : 1;
        Flash::setMsg($xml->msg .":". $xml->msg_erro, $erro);
        
        $this->redirect(URL_BASE."notafiscal");
        
    }
    
     public function inutilizarNfe($id_nfe) {
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::inuttilizarNfe($notafiscal);
        
        $erro = ($xml->erro > 0) ? -1 : 1;
        Flash::setMsg($xml->msg .":". $xml->msg_erro, $erro);
        
        $this->redirect(URL_BASE."notafiscal");
        
    }
    
    
    
    public function danfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe);     
        $xml = NfeService::danfe($notafiscal);
    }
    
 

}

