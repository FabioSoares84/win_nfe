<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\Service;

class NotafiscalController extends Controller{
   private $tabela = "nfe";
   private $campo  = "id_nfe";  
  
   
    public function index(){
       $dados["view"]  = "NotaFiscal/Index";
       $this->load("template", $dados);
    }        
    
    public function create(){
        $dados["view"] 		   = "NotaFiscal/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id){
        
        $dados["view"]          = "NotaFiscal/Edit";
        $this->load("template", $dados);
    }
    
     
    
    public function excluir($id){
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE."emitente");
    }
    
   
    
    
}

