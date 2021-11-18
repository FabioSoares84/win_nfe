<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\Service;
use app\models\service\ProdutoService;

class ConfiguracaoController extends Controller{
   private $tabela = "configuracao";
   private $campo  = "id_configuracao"; 
   
   
    public function index(){
       $dados["lista"] = ProdutoService::lista();
       $dados["view"]  = "Produto/Index";
       $this->load("template", $dados);
    }
    
    public function create(){
        $dados["cfops"]    = Service::lista("cfop");  
        $dados["unidades"] = Service::lista("unidade");
        $dados["tributacoes"] = Service::lista("tributacao");
        $dados["view"]     = "Produto/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id){
        $produto = ProdutoService::getProduto($id);       
        if(!$produto){
            $this->redirect(URL_BASE."produto");
        }
        $dados["produto"]  = $produto;
        $dados["cfops"]    = Service::lista("cfop");  
        $dados["unidades"] = Service::lista("unidade");
        $dados["tributacoes"] = Service::lista("tributacao");
        $dados["view"]      = "Produto/Create";
        $this->load("template", $dados);
    }
    
    public function salvar(){
        $produto = new \stdClass();
        
        $produto->id_produto    = ($_POST["id_produto"]) ? $_POST["id_produto"] : null ; 
        $produto->produto       = $_POST["produto"];
        $produto->id_unidade    = $_POST["id_unidade"];
        $produto->preco         = $_POST["preco"];
        $produto->cfop          = $_POST["cfop"];
        $produto->extipi        = $_POST["extipi"];
        $produto->gtin          = ($_POST['gtin']) ? $_POST['gtin'] : "SEM GTIN";
        $produto->cest          = $_POST["cest"];
        $produto->cbenef        = $_POST["cbenef"];
        $produto->mva           = $_POST["mva"];
        $produto->nfci          = $_POST["nfci"];

        $produto->data_cadastro  = date("Y-m-d");

        Flash::setForm($produto);
        if(ProdutoService::salvar($produto, $this->campo, $this->tabela)){
            $this->redirect(URL_BASE."produto");
        }else{
            if(!$produto->id_produto){
                $this->redirect(URL_BASE."produto/create");
            }else{
                $this->redirect(URL_BASE."produto/edit/".$produto->id_produto);
            }
        }
    }
  
    
    public function excluir($id){
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE."produto");
    }
    
    
}

