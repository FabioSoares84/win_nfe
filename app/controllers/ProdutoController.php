<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\Service;

class ProdutoController extends Controller{
   private $tabela = "produto";
   private $campo  = "id_produto"; 
   
   
    public function index(){
       $dados["view"]  = "Produto/Index";
       $this->load("template", $dados);
    }
    
    public function create(){
        $dados["view"] = "Produto/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id){
        $produto = Service::get($this->tabela, $this->campo, $id);       
        if(!$produto){
            $this->redirect(URL_BASE."produto");
        }
        
        $dados["view"]      = "Produto/Create";
        $this->load("template", $dados);
    }
  
    
    public function excluir($id){
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE."produto");
    }
    
    
}

