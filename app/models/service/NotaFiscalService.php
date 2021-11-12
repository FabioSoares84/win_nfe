<?php
namespace app\models\service;

use app\models\service\ItemVendaService;
use app\controllers\ItemnotafiscalController;
use app\models\dao\NotaFiscalDao;


class NotaFiscalService{

    public static function salvarNota($id_venda){
        
        $configuracao = Service::get("configuracao", "id_configuracao", 1);
        $venda        = Service::get("venda", "id_venda", $id_venda);
        $empresa      = Service::get("emitente", "id_emitente", $configuracao->empresa_padrao);
        $estado       = Service::get("estado","uf_estado",$empresa->uf);
        $cliente      = Service::get("cliente", "id_cliente", $venda->id_cliente);
        $itens        = ItemVendaService::ListaPorVenda($id_venda);
        
        $nota = new \stdClass();
        $nota->id_venda = $id_venda;
        $nota->cUF      = $estado->codigo_estado;
        $nota->natOp    = $configuracao->natureza_padrao;
        
        $nota->indPag   = 0; //Não Existe mais na versão 4.00
        $nota->modelo      = 55; // Modelo Nota fiscal Eletronica
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
      
        $nota->cMunFG = $empresa->ibge;
        $nota->tpImp  = 1;
        $nota->tpEmis = 1;
        $nota->tpAmb = $configuracao->nfe_ambiente; //1=Produção; 2=Homologação
        $nota->finNFe = 1;
        $nota->indFinal = $configuracao->indFinal;
        $nota->indPres = 2;    //Indica presença do comprador
        $nota->indIntermed = 0; //usar a partir de 05/04/2021    
        $nota->procEmi = 0;
        $nota->verProc = '1.0.0';
        $nota->dhCont = null;  //entrada em contingência AAAA-MM-DDThh:mm:ssTZD
        $nota->xJust = null;   //Justificativa da entrada em contingência
        $nota->tPag   = $configuracao->tipo_pagamento;
        $nota->modFrete = $configuracao->tipo_frete;
        
        //Dados Emitente
        $nota->em_xNome = $empresa->razao_social;  //TirarAcento
        $nota->em_xFant = $empresa->nome_fantasia;  //Tirar Acento
        $nota->em_IE    = $empresa->ie;
        $nota->em_IEST  = $empresa->iest;
        $nota->em_IM    = $empresa->im;
        $nota->em_CNAE  = $empresa->cnae;
        $nota->em_CRT   = $empresa->crt;
        $nota->em_CNPJ     = $empresa->cnpj;
        //Endereço Emitente
        $nota->em_xLgr  = $empresa->logradouro;
        $nota->em_nro   = $empresa->numero;
        $nota->em_xCpl  = $empresa->complemento;
        $nota->em_xBairro = $empresa->bairro;
        $nota->em_cMun    = $empresa->ibge;
        $nota->em_xMun    = $empresa->cidade;
        $nota->em_UF      = $empresa->uf;
        $nota->em_CEP     = $empresa->cep;
        $nota->em_cPais   = "1058";
        $nota->em_xPais   = "Brasil";
        $nota->em_fone    = $empresa->fone; 
        $nota->atualizacao= $empresa->ultima_atualizacao;
        
        $nfe = Service::get("nfe","id_venda" ,$id_venda);
        if(!$nfe){
            $nota->id_status = 2;
            $id_nfe = Service::inserir(objToArray($nota), "nfe");
        }else{
            if($nfe->id_status < 7){
                $nota->id_status = 2;
                $nota->id_nfe = $nfe->id_nfe;
                Service::editar(objToArray($nota), "id_nfe", "nfe"); 
            }else{
                return $nfe->id_nfe;
            }
            $id_nfe = $nfe->id_nfe;
        }
        //Dados Destinatario
        $dest = new \stdClass();
        $dest->id_nfe             = $id_nfe;
        $dest->dest_xNome         = $cliente->nome;
        $dest->dest_IE            = $cliente->ie;
        $dest->dest_indIEDest     = $cliente->indIEDest;
        $dest->dest_ISUF          = $cliente->suframa;
        $dest->dest_IM            = $cliente->im;
        $dest->dest_email         = $cliente->email;
        $dest->dest_CNPJ          = $cliente->cnpj;
        $dest->dest_CPF           = $cliente->cpf;
        $dest->dest_idEstrangeiro = $cliente->idEstrangeiro;
        //Endereço Destinatario
        $dest->dest_xLgr          = $cliente->logradouro;
        $dest->dest_nro           = $cliente->numero;
        $dest->dest_xCpl          = $cliente->complemento;
        $dest->dest_xBairro       = $cliente->bairro;
        $dest->dest_cMun          = $cliente->ibge;
        $dest->dest_xMun          = $cliente->cidade;
        $dest->dest_UF            = $cliente->uf;
        $dest->dest_CEP           = $cliente->cep;
        $dest->dest_cPais         = "1058";
        $dest->dest_xPais         = "Brasil";
        $dest->dest_fone          = $cliente->fone;
        
        $d = Service::get("nfe_destinatario", "id_nfe", $id_nfe);
        if(!$d){
            Service::inserir(objToArray($dest), "nfe_destinatario");
        }else{
            $dest->id_destinatario = $d->id_destinatario;
            Service::editar(objToArray($dest), "id_destinatario", "nfe_destinatario");
        }
        
        //Listando os Itens
        $j = 0; 
        $total = 0;
        foreach ($itens as $i){
           
            $item = new \stdClass();
            $item->id_nfe       = $id_nfe;
            $item->numero_item  = $j++; //item da nota
            $item->cProd        = $i->id_produto;
            $item->cEAN         = $i->gtin;
            $item->xProd        = $i->produto;
            $item->NCM          = $i->ncm;
            $item->cBenef       = $i->cbenef; //incluido no layout 4.00
            
            $item->EXTIPI      = $i->extipi;
            $item->CFOP        = $i->cfop;
            $item->uCom        = $i->abrev;
            $item->qCom        = $i->qtde;
            $item->vUnCom      = $i->valor;
            $item->vProd       = $item->vUnCom * $item->qCom;
            $item->cEANTrib    = $i->gtin;
            $item->uTrib       = $i->abrev;
            $item->qTrib       = $i->qtde;
            $item->vUnTrib     = $i->valor;
            $item->vFrete      = null;
            $item->vSeg        = null;
            $item->vDesc       = null;
            $item->vOutro      = null;
            $item->indTot      = 1;
            $item->xPed        = $id_nfe;
            $item->nItemPed    = $item->numero_item;
            $item->nFCI        = $i->nfci;
            
            $total             += $item->vProd;
            
            $it = ItemnotafiscalController::existeItem($id_nfe, $i->id_produto);
            if(!$it){
                Service::inserir(objToArray($item), "nfe_item");
            }else{
                $item->id_nfe_item = $it->id_nfe_item;
                Service::editar(objToArray($item), "id_nfe_item", "nfe_item");
            }
             
        }
        Service::editar(["id_nfe"=>$total, "Vliq"=>$total, "vProd"=>$total, "vProd"=>$total, "vNF"=>$total], "id_nfe", "nfe");
        
    }
    
    public static function lista(){
        $dao = new NotaFiscalDao();
        return $dao->lista();
    }
    
    public static function getNotaFiscal($id_nfe){
        $dao = new NotaFiscalDao();
        $retorno = (object) array(
            "nfe"          => $dao->getNotaFiscal($id_nfe),
            "destinatario" => Service::get("nfe_destinatario", "id_nfe", $id_nfe),
            "itens"        => Service::get("nfe_item", "id_nfe", $id_nfe, true),
            "configuracao" => Service::get("configuracao", "id_configuracao",1)
        );
        return $retorno;
    }

    public static function getNotaEmDigitacao(){
        $dao = new NotaFiscalDao();
        return $dao->getNotaEmDigitacao();
    }
    
    public static function salvarChave($id_nfe,$chave) {
        $dao = new NotaFiscalDao();
        return $dao->salvarChave($id_nfe, $chave);
    }
    
    public static function salvarRecebido($id_nfe,$recibo) {
        $dao = new NotaFiscalDao();
        return $dao->salvarRecibo($id_nfe, $recibo);
    }
    
     public static function salvarProtocolo($id_nfe,$protocolo) {
        $dao = new NotaFiscalDao();
        return $dao->salvarProtocolo($id_nfe, $protocolo);
    }
    
    public static function mudarStatus($id_nfe,$id_status) {
        $dao = new NotaFiscalDao();
        return $dao->mudarStatus($id_nfe, $id_status);
    }
}