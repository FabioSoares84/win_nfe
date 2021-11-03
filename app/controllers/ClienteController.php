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
    
       public function salvar(){
        $cliente = new \stdClass();
        
        $cliente->id_cliente          = ($_POST["id_cliente"]) ? $_POST["id_cliente"] : null ; 
        $cliente->nome                = $_POST["razao_social"];   //xNome
        $cliente->nome_fantasia       = $_POST["nome_fantasia"];  //xFant
        $cliente->cpf                 = $_POST["cnpj"];           //CNPJ
        $cliente->cnpj                = $_POST["ie"];   
        $cliente->fone                = $_POST["fone"];  ////IE
        $cliente->celular             = $_POST["fone"];  //
        $cliente->im                  = $_POST["im"];             //IM
        $cliente->iest                = $_POST["iest"];           //IEST
      
        $cliente->email               = $_POST["email"];
        $cliente->email_contabilidade = $_POST["email_contabilidade"];
        
        $cliente->cep                 = $_POST["cep"];        //CEP
        $cliente->logradouro          = $_POST["logradouro"]; //xLgr
        $cliente->numero              = $_POST["numero"];     //Nro
        $cliente->bairro              = $_POST["bairro"];
        $cliente->complemento         = $_POST["complemento"];  //xCpl 
        $cliente->uf                  = $_POST["uf"];
        $cliente->cidade              = $_POST["cidade"];
        $cliente->ibge                  = $_POST["ibge"];
        $cliente->cnae                = $_POST["cnae"];           //CNAE
        $cliente->crt                 = $_POST["crt"];            //CRT
        
        $emitente->data_cadastro  = date("Y-m-d");

        Flash::setForm($emitente);
        if(EmitenteService::salvar($emitente, $this->campo, $this->tabela)){
            $this->redirect(URL_BASE."emitente");
        }else{
            if(!$emitente->id_cliente){
                $this->redirect(URL_BASE."emitente/create");
            }else{
                $this->redirect(URL_BASE."emitente/edit/".$emitente->id_emitente);
            }
        }
    }
    
     public function excluir($id){
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE."cliente");
    }
   
    
}

