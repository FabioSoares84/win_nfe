<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\Service;
use app\models\service\VendaService;
use app\models\service\ItemVendaService;
use app\models\service\ProdutoService;
use app\models\service\NotaFiscalService;

class VendaController extends Controller{
   private $tabela = "venda";
   private $campo  = "id_venda";  
  
   
    public function index(){
       $dados["vendas"]= VendaService::Lista();
       $dados["view"]  = "Venda/Index";
       $this->load("template", $dados);
    }        
    
    public function create(){
        $venda = Service::get($this->tabela, "finalizada", "N");
           if($venda){
               $this->redirect(URL_BASE. "venda/edit/".$venda->id_venda);              
           }
        $dados["clientes"] = Service::lista("cliente");
        $dados["view"]     = "Venda/Create";
        $this->load("template", $dados);
    }
    
    public function salvar(){
        $venda = new \stdClass();  
        $venda->id_venda    = ($_POST["id_venda"]) ? $_POST["id_venda"] : null ; 
        $venda->data_venda  = $_POST["data_venda"];
        $venda->hora_venda  = $_POST["hora_venda"];
        $venda->id_cliente  = $_POST["id_cliente"];
        
        $id_venda = Service::inserir(objToArray($venda), $this->tabela);
        $this->redirect(URL_BASE."venda/edit/".$id_venda);
    }
    
    public function edit($id_venda){  
        $dados["venda"]    = VendaService::getVenda($id_venda);
        $dados["itens"]    = ItemVendaService::ListaPorVenda($id_venda);
        $dados["produtos"] = ProdutoService::lista();
        $dados["view"]     = "Venda/Itens";
        $this->load("template", $dados);
    }
    
    public function excluirItens($id_venda){
        Service::excluir("item_venda", $this->campo, $id_venda);
        VendaService::atualizarVenda($id_venda);
        $this->redirect(URL_BASE."venda/edit/".$id_venda); 
    }
    
    public function excluir($id){
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE."venda");
    }
    
     public function finalizar($id_venda){
        $total = Service::getSoma("item_venda","subtotal","id_venda", $id_venda);
        Service::editar(["finalizada"=>"S", "id_venda"=>$id_venda, "total"=>$total],"id_venda", $this->tabela);
        NotaFiscalService::salvarNota($id_venda);
        $this->redirect(URL_BASE."notafiscal"); 
    }
    
    
}

