<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\Service;
use app\models\service\TributacaoService;
use app\core\Flash;

class TributacaoController extends Controller{
    private $tabela = "tributacao";
    private $campo  = "id_tributacao";
    
    public function index(){
        $dados["lista"] = Service::lista($this->tabela);
        $dados["view"]  = "Tributacao/Index";
        $this->load("template", $dados);
    }
    
    public function create() {
        $dados["tributacao"] = Flash::getForm();
        $dados["view"]       = "Tributacao/Create";
        $this->load("template", $dados);
    }
    
    public function salvar(){
        $tributacao = new \stdClass();
        $tributacao->id_tributacao = ($_POST["id_tributacao"]) ? $_POST["id_tributacao"] :  null;
        $tributacao->tributacao    =  $_POST["tributacao"];
        
        Flash::setForm($tributacao);
        $retorno = TributacaoService::salvar($tributacao, $this->campo, $this->tabela);
        
        if($retorno->resultado){
            $this->redirect(URL_BASE."tributacao");
        }else{
            if($tributacao->id){
                $this->redirect(URL_BASE."tributacao/edit/" .$tributacao->id);
            }else{
                $this->redirect(URL_BASE."tributacao/create");
            }
        }
    }
    
    public function edit($id){
        $tributacao = Service::get($this->tabela, $this->campo, $id);
        if(!$tributaca){
            $this->redirect(URL_BASE."tributacao");
        }
        $dados["tributacao"] = $tributaca;
        $dados["view"]       = "Tributacao/Create";
        $this->load("template", $dados);
     }
    
    public function tributos($id_tributacao){
        $tributacao = Service::get($this->tabela, $this->campo, $id_tributacao);
        
        if(!$tributacao){
            $$this->redirect(URL_BASE. "tributacao");
        }
        
        $dados["lista_cst_ipi"] = Service::lista("cst_ipi");
        $dados["tributacao"] = $tributacao;
        $dados["view"]       = "Tributacao/tributos";
        $this->load("template", $dados);
    }
  
    
 

}

