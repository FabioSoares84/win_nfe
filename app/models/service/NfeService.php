<?php
namespace app\models\service;

use NFePHP\NFe\Make;
use Exception;
use app\models\service\NotaFiscalService;
use app\models\service\XmlService;

class NfeService{

    public static function gerarxml($notafiscal){
        $nfe = new Make();
        $std = new \stdClass();
        $std->versao = '4.00'; //versão do layout (string)
        $std->Id = ''; //se o Id de 44 digitos não for passado será gerado automaticamente
        $std->pk_nItem = null; //deixe essa variavel sempre como NULL
        $nfe->taginfNFe($std);
        
        self::identifica($nfe, $notafiscal->nfe);
        self::emitente($nfe, $notafiscal->nfe);
        self::destinatario($nfe, $notafiscal->destinatario);
        //Produtos
        $itens = $notafiscal->itens;
        $cont = 0;
        foreach ($itens as $item){
            $cont++;
            ItemNfeService::dadosProduto($cont, $nfe, $item);
            ItemNfeService::tagImposto($cont, $nfe, $notafiscal->nfe);
            ItemNfeService::icmsSn($cont, $nfe);
            ItemNfeService::pis($cont, $nfe);
            ItemNfeService::cofins($cont, $nfe);
        }
        self::totais($nfe, $notafiscal->nfe);
        //transporte
        $std = new \stdClass();
        $std->modFrete = 0;
        $nfe->tagtransp($std);
        
        self::fatura($nfe, $notafiscal->nfe);
        self::pagamento($nfe,$notafiscal->nfe);
        $retorno = new \stdClass();
        try {
            $result = $nfe->montaNFe();
            if($result){
               //header("Content-type: text/xml; charset=UTF-8");
               $xml = $nfe->getXML();
               $chave = $nfe->getChave();
               $nomeXml = $chave ."-nfe.xml";
               $pastaAmbiente = ($notafiscal->nfe->tpAmb=="1") ? "producao" : "homologacao";
               $path = "Notas/{$pastaAmbiente}/temporarias/".$nomeXml;
               file_put_contents($path, $xml);  //salvar arquivo dar nome e salvar conteudo
               chmod($path, 0777); //Permissão de escrita
               NotaFiscalService::salvarChave($notafiscal->nfe->id_nfe, $chave);
               XmlService::salvar($notafiscal->nfe->id_nfe, $xml);
               $retorno->erro = -1;
               $retorno->msg = "XML gerado com sucesso";
               $retorno->msg_erro = ""; 
            }else{
               $retorno->erro = 1;
               $retorno->msg = "Não foi Possível Gerar XML";
               $retorno->msg_erro = $nfe->getErrors(); 
            }
        } catch (Exception $e) {
            i($nfe->getErrors());
        }
        return $retorno;
    }
    
    public static function identifica($nfe,$identificacao){
        $std = new \stdClass();
        $std->cUF       = $identificacao->cUF;      //codigo numerico do estado
        $std->cNF       = $identificacao->cNF;      //numero aleatório da NF
        $std->natOp     = $identificacao->natOp;    //natureza da operacao        
        $std->indPag    = 0;                        //NÃO EXISTE MAIS NA VERSÃO 4.00
        $std->mod       = $identificacao->modelo;   //Modelo NFe 55 ou 65
        $std->serie     = $identificacao->serie;    //Serie da NFe
        $std->nNF       = $identificacao->nNF;      //Numero da NFe
        $std->dhEmi     = $identificacao->dhEmi;    //data("Y-m-d\TH:i:sP"); 
        $std->dhSaiEnt  = $identificacao->dhSaiEnt;
        $std->tpNF      = $identificacao->tpNF;
        $std->idDest    = $identificacao->idDest;
        $std->cMunFG    = $identificacao->cMunFG;
        $std->tpImp     = $identificacao->tpImp;
        $std->tpEmis    = $identificacao->tpEmis;
        $std->tpAmb     = $identificacao->tpAmb;
        $std->finNFe    = $identificacao->finNFe;
        $std->indFinal  = $identificacao->indFinal;
        $std->indPres   = $identificacao->indPres;
        $std->procEmi   = $identificacao->procEmi;
        $std->verProc   = $identificacao->verProc;
        $nfe->tagide($std);
    }
    
    public static function emitente($nfe,$emitente) {
        $std = new \stdClass();
        $std->xNome  = $emitente->em_xNome;
        $std->xFant  = $emitente->em_xFant;
        $std->IE     = $emitente->em_IE;
        $std->IEST   = $emitente->em_IEST;
        $std->IM     = $emitente->em_IM;
        $std->CNAE   = $emitente->em_CNAE;
        $std->CRT    = $emitente->em_CRT;
        if($emitente->em_CNPJ):
            $std->CNPJ = $emitente->em_CNPJ;
            $std->CPF  = NULL;
        elseif($emitente->em_CPF):
            $std->CNPJ = NULL;
            $std->CPF  = $emitente->em_CPF;
        else:
            $std->CNPJ = NULL;
            $std->CPF  = NULL;
        endif;  
        $nfe->tagemit($std);  
        //endereço do emitente
        $std = new \stdClass();
        $std->xLgr     = $emitente->em_xLgr;
        $std->nro      = $emitente->em_nro;
        $std->xCpl     = $emitente->em_xCpl;
        $std->xBairro  = $emitente->em_xBairro;
        $std->cMun     = $emitente->em_cMun;
        $std->xMun     = $emitente->em_xMun;
        $std->UF       = $emitente->em_UF;
        $std->CEP      = $emitente->em_CEP;
        $std->cPais    = $emitente->em_cPais;
        $std->xPais    = $emitente->em_xPais;
        $std->fone     = $emitente->em_fone; 
        
        $nfe->tagenderEmit($std);
    }
    
    public static function destinatario($nfe,$destinatario){
        $std = new \stdClass();
        $std->xNome         = $destinatario->dest_xNome;
        $std->indIEDest     = 2;
        $std->IE            = $destinatario->dest_IE;
        $std->ISUF          = $destinatario->dest_ISUF;
        $std->IM            = $destinatario->dest_IM;
        $std->email         = $destinatario->dest_email;
        $std->idEstrangeiro = $destinatario->dest_idEstrangeiro;
        if($destinatario->dest_CNPJ):
            $std->CNPJ = $destinatario->dest_CNPJ;
            $std->CPF  = NULL;
        elseif($destinatario->dest_CPF):
            $std->CNPJ = NULL;
            $std->CPF  = $destinatario->dest_CPF;
        else:
            $std->CNPJ = NULL;
            $std->CPF  = NULL;
        endif; 
        $nfe->tagdest($std);     
        $std = new \stdClass();
        $std->xLgr         = $destinatario->dest_xLgr;
        $std->nro          = $destinatario->dest_nro;
        $std->xCpl         = $destinatario->dest_xCpl;
        $std->xBairro      = $destinatario->dest_xBairro;
        $std->cMun         = $destinatario->dest_cMun;
        $std->xMun         = $destinatario->dest_xMun;
        $std->UF           = $destinatario->dest_UF;
        $std->CEP          = $destinatario->dest_CEP;
        $std->cPais        = $destinatario->dest_cPais;
        $std->xPais        = $destinatario->dest_xPais;
        $std->fone         = $destinatario->dest_fone;
        
        $nfe->tagenderDest($std);  
    }
 
    public static function totais($nfe, $notafiscal){
        $std = new \stdClass();
        $std->vBC        = $notafiscal->vBC;
        $std->vICMS      = $notafiscal->vICMS;
        $std->vICMSDeson = $notafiscal->vICMSDeson;
        $std->vFCP       = $notafiscal->vFCP; //incluso no layout 4.00
        $std->vBCST      = $notafiscal->vBCST;
        $std->vST        = $notafiscal->vST;
        $std->vFCPST     = $notafiscal->vFCPST; //incluso no layout 4.00
        $std->vFCPSTRet  = $notafiscal->vFCPSTRet; //incluso no layout 4.00
        $std->vProd      = $notafiscal->vProd;
        $std->vFrete     = $notafiscal->vFrete;
        $std->vSeg       = $notafiscal->vSeg;
        $std->vDesc      = $notafiscal->vDesc;
        $std->vII        = $notafiscal->vII;
        $std->vIPI       = $notafiscal->vIPI;
        $std->vIPIDevol  = $notafiscal->vIPIDevol; //incluso no layout 4.00
        $std->vPIS       = $notafiscal->vPIS;
        $std->vCOFINS    = $notafiscal->vCOFINS;
        $std->vOutro     = ($notafiscal->vOutro) ? $notafiscal->vOutro : NULL;
        $std->vNF        = $notafiscal->vNF;
        $std->vTotTrib   = $notafiscal->vTotTrib;
      
        $nfe->tagICMSTot($std);
    }
    
    public static function transp($nfe,$notafiscal){
        $std = new \stdClass();
        $std->modFrete = 0;
        $nfe->tagtransp($std);
    }
    
    public static function fatura($nfe,$notafiscal){
        $std = new \stdClass();
        $std->nFat  = $notafiscal->id_nfe;
        $std->vOrig = $notafiscal->vOrig;
        $std->vDesc = $notafiscal->vDesc;
        $std->vLiq  = $notafiscal->vLiq;

        $nfe->tagfat($std);
    }
    
    public static function pagamento($nfe, $notafiscal){
        $std            = new \stdClass();
        $std->vTroco    = null; //incluso no layout 4.00, obrigatório informar para NFCe (65)
        $nfe->tagpag($std); 
       
        $std            = new \stdClass();
        $std->tPag      = '03';
        $std->vPag      = $notafiscal->vOrig; //Obs: deve ser informado o valor pago pelo cliente
        $std->CNPJ      = null;
        $std->tBand     = null;
        $std->cAut      = null;
        $std->tpIntegra = null; //incluso na NT 2015/002
        $std->indPag    = '0'; //0= Pagamento à Vista 1= Pagamento à Prazo

        $nfe->tagdetPag($std);
    }

}