<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\Service;

class VendaController extends Controller{
   private $tabela = "venda";
   private $campo  = "id_venda";  
  
   
    public function index(){
       $dados["view"]  = "Venda/Index";
       $this->load("template", $dados);
    }        
    
    public function create(){
        $dados["view"] 		   = "Venda/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id){        
        $dados["view"]          = "Venda/Itens";
        $this->load("template", $dados);
    }
    
     
    
    public function excluir($id){
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE."emitente");
    }
    
   
    
    
}

