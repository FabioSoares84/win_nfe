<?php
namespace app\models\service;

use app\models\service\ItemVendaService;


class NotaFiscalService{

    public static function salvarNota($id_venda){
        $configuracao = Service::get("configuracao", "id_configuracao", 1);
        $venda        = Service::get("venda", "id_venda", $id_venda);
        $empresa      = Service::get("emitente", "id_emitente", $configuracao->empresa_padrao);
        $estado       = Service::get("estado","uf_estado",$empresa->uf);
        $cliente      = Service::get("cliente", "id_cliente", $venda->id_cliente);
        $itens        = ItemVendaService::ListaPorVenda($id_venda);
        
        $nota = new \stdClass();
        $nota->id_vemda = $id_venda;
        $nota->cUF      = $estado->codigo_estado;
        $nota->natOp    = $configuracao->natureza_operacao;
        
        $nota->indPag   = 0; //Não Existe mais na versão 4.00
        $nota->mod      = 55; // Modelo Nota fiscal Eletronica
        $nota->serie    = $configuracao->nfe_serie;
        $nota->nNF      = $configuracao->ultimanfe + 1;
        $nota->cNF      = rand($nota->nNF,99999999);
        $nota->dhEmi    = hoje()."T".agora()."-03:00";
        $nota->dhSaiEnt = null;
        $nota->tpNF     = $configuracao->tipo_nota_padrao;
        
        //Verifica o destino da operação
        if($empresa->uf !="EX"){
            if($empresa->uf == $cliente->uf){
                $nota->idDest   = 1;
            }else{
                $nota->idDest   = 2;
            }
        }else{
            $nota->idDest   = 3;
        }
      
        $nota->cMunFG   = $empresa->ibge;
        $nota->tpImp    = 1; //configurar isso em configurações
        $nota->tpEmis   = 1;
        $nota->cDV   =   1;
        $nota->tpAmb   = 1;
        
        
       
    }

}