<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\Service;
use app\models\service\ClienteService;

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
    
       public function salvar(){
        $cliente = new \stdClass();
        
        $cliente->id_cliente          = ($_POST["id_cliente"]) ? $_POST["id_cliente"] : null ; 
        $cliente->nome                = $_POST["nome"];   
        $cliente->nome_fantasia       = $_POST["nome_fantasia"];  
        $cliente->cpf                 = $_POST["cpf"];           
        $cliente->cnpj                = tira_mascara($_POST["cnpj"]);   
        $cliente->fone                = $_POST["fone"];  
        $cliente->celular             = $_POST["celular"];  
        $cliente->email               = $_POST["email"];
        
        $cliente->cep                 = $_POST["cep"];        //CEP
        $cliente->logradouro          = $_POST["logradouro"]; //xLgr
        $cliente->numero              = $_POST["numero"];     //Nro
        $cliente->bairro              = $_POST["bairro"];
        $cliente->complemento         = $_POST["complemento"];  //xCpl 
        $cliente->uf                  = $_POST["uf"];
        $cliente->cidade              = $_POST["cidade"];
        
        $cliente->ie                  = $_POST["ie"];           
        $cliente->im                  = $_POST["im"];             
        $cliente->rg                  = $_POST["rg"];           
      
        $cliente->suframa             = $_POST["suframa"];
        $cliente->ie_subt_trib        = $_POST["ie_subt_trib"];
        $cliente->ibge                = $_POST["ibge"];
        
        $cliente->data_cadastro  = date("Y-m-d");

        Flash::setForm($cliente);
        if(ClienteService::salvar($cliente, $this->campo, $this->tabela)){
            $this->redirect(URL_BASE."cliente");
        }else{
            if(!$cliente->id_cliente){
                $this->redirect(URL_BASE."cliente/create");
            }else{
                $this->redirect(URL_BASE."cliente/edit/".$cliente->id_cliente);
            }
        }
    }
    
     public function excluir($id){
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE."cliente");
    }
   
    
}

