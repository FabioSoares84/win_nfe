<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\EmitenteService;

class EmitenteController extends Controller{
   private $tabela = "emitente";
   private $campo  = "id_emitente"; 
   
    public function index(){
       $dados["lista"] = Service::lista($this->tabela); 
       $dados["view"]  = "Emitente/Index";
       $this->load("template", $dados);
    }
    
    public function create(){
        $dados["emitente"]    = Flash::getForm();      
        $dados["view"] = "Emitente/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id){
        $emitente = Service::get($this->tabela, $this->campo, $id);       
        if(!$emitente){
            $this->redirect(URL_BASE."emitente");
        }
        
        $dados["emitente"]   = $emitente;
        $dados["view"]      = "Emitente/Create";
        $this->load("template", $dados);
    }
     
    public function salvar(){
        $emitente = new \stdClass();
        
        $emitente->id_emitente         = ($_POST["id_emitente"]) ? $_POST["id_emitente"] : null ; 
        $emitente->razao_social        = $_POST["razao_social"];   //xNome
        $emitente->nome_fantasia       = $_POST["nome_fantasia"];  //xFant
        $emitente->cnpj                = $_POST["cnpj"];           //CNPJ
        $emitente->ie                  = $_POST["ie"];             //IE
        $emitente->im                  = $_POST["im"];             //IM
        $emitente->iest                = $_POST["iest"];           //IEST
        $emitente->fone                = $_POST["fone"];  //
        $emitente->email               = $_POST["email"];
        $emitente->email_contabilidade = $_POST["email_contabilidade"];
        
        $emitente->cep                 = $_POST["cep"];        //CEP
        $emitente->logradouro          = $_POST["logradouro"]; //xLgr
        $emitente->numero              = $_POST["numero"];     //Nro
        $emitente->bairro              = $_POST["bairro"];
        $emitente->complemento         = $_POST["complemento"];  //xCpl 
        $emitente->uf                  = $_POST["uf"];
        $emitente->cidade              = $_POST["cidade"];
        $emitente->ibge                  = $_POST["ibge"];
        $emitente->cnae                = $_POST["cnae"];           //CNAE
        $emitente->crt                 = $_POST["crt"];            //CRT
        
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
        $this->redirect(URL_BASE."emitente");
    }
    
    
    
}

