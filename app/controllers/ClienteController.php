<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\Service;

class ClienteController extends Controller{
   private $tabela = "cliente";
   private $campo  = "id_cliente"; 
   
    public function index(){
       $dados["lista"] = Service::lista($this->tabela); 
       $dados["view"]  = "Cliente/Index";
       $this->load("template", $dados);
    }
    
    public function create(){
        $dados["cliente"]    = Flash::getForm();      
        $dados["view"] = "Cliente/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id){
        $cliente = Service::get($this->tabela, $this->campo, $id);       
        if(!$cliente){
            $this->redirect(URL_BASE."cliente");
        }
        
        $dados["cliente"]   = $cliente;
        $dados["view"]      = "Cliente/Create";
        $this->load("template", $dados);
    }
    
    
    
   
    
}

