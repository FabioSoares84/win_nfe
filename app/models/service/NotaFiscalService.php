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
        $nota->em_xNome = $empresa->razao_social;
        $nota->em_xFant = $empresa->nome_fantasia;
        $nota->em_IE    = $empresa->ie;
        $nota->em_IEST  = $empresa->iest;
        $nota->em_IM    = $empresa->im;
        $nota->em_CNAE  = $empresa->cnae;
        $nota->em_CRT   = $empresa->regime_tributario;
        $nota->em_CNPJ     = $empresa->cnpj;
        
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
        
        if(!$id_nfe){
            echo "Erro";
            exit;
        }
        
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
            $dest->id_destinatario = $d->id_destinarario;
            Service::editar(objToArray($dest), "id_destinarario", "nfe_destinatario");
        }
    
        
    }

}