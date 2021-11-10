<?php
namespace app\models\service;

use NFePHP\NFe\Make;

class ItemNfeService{
    
    public static function tagImposto($cont, $nfe, $notaFiscal){
        //INICIA TOTAL TRIBUTOS
        $std = new \stdClass();
        $std->item     = $cont;   //item da NFe
        $std->vTotTrib = $notaFiscal->vTotTrib;
        $nfe->tagimposto($std);
        //Fim TOT TRIB
    }

    public static function dadosProduto($cont, $nfe, $item){
    $std = new \stdClass();
    $std->item      = $cont; //item da NFe
    $std->cProd     = $item->cProd;
    $std->cEAN      = $item->cEAN;
    $std->xProd     = $item->xProd;
    $std->NCM       = $item->NCM;
    $std->cBenef    = $item->cBenef; //incluido no layout 4.00
    $std->EXTIPI    = $item->EXTIPI;
    $std->CFOP      = $item->CFOP;
    $std->uCom      = $item->uCom;
    $std->qCom      = $item->qCom;
    $std->vUnCom    = $item->vUnCom;
    $std->vProd     = $item->vProd;
    $std->cEANTrib  = $item->cEANTrib;
    $std->uTrib     = $item->uTrib;
    $std->qTrib     = $item->qTrib;
    $std->vUnTrib   = $item->vUnTrib;
    $std->vFrete    = $item->vFrete;
    $std->vSeg      = $item->vSeg;
    $std->vDesc     = $item->vDesc;
    $std->vOutro    = $item->vOutro;
    $std->indTot    = $item->indTot;
    $std->xPed      = $item->xPed;
    $std->nItemPed  = $item->nItemPed;
    $std->nFCI      = $item->nFCI;
    $nfe->tagprod($std);
    }
    
    public static function icmsSn($cont,$nfe){
        $std = new \stdClass();
        $std->item = $cont; //item da NFe
        $std->orig = 0;
        $std->CSOSN = '103';
       /* $std->pCredSN = 2.00;
        $std->vCredICMSSN = 20.00;
        $std->modBCST = null;
        $std->pMVAST = null;
        $std->pRedBCST = null;
        $std->vBCST = null;
        $std->pICMSST = null;
        $std->vICMSST = null;
        $std->vBCFCPST = null; //incluso no layout 4.00
        $std->pFCPST = null; //incluso no layout 4.00
        $std->vFCPST = null; //incluso no layout 4.00
        $std->vBCSTRet = null;
        $std->pST = null;
        $std->vICMSSTRet = null;
        $std->vBCFCPSTRet = null; //incluso no layout 4.00
        $std->pFCPSTRet = null; //incluso no layout 4.00
        $std->vFCPSTRet = null; //incluso no layout 4.00
        $std->modBC = null;
        $std->vBC = null;
        $std->pRedBC = null;
        $std->pICMS = null;
        $std->vICMS = null;
        $std->pRedBCEfet = null;
        $std->vBCEfet = null;
        $std->pICMSEfet = null;
        $std->vICMSEfet = null;
        $std->vICMSSubstituto = null;
        */
        $nfe->tagICMSSN($std);
        
    }
    
    public static function pis($cont,$nfe){
        $std = new \stdClass();
        $std->item = $cont; //item da NFe
        $std->CST = '07';
        $std->vBC = null;
        $std->pPIS = null;
        $std->vPIS = null;
        $std->qBCProd = null;
        $std->vAliqProd = null;

        $nfe->tagPIS($std);
        
    }
    
    public static function cofins($cont,$nfe){
        $std = new \stdClass();
        $std->item = $cont; //item da NFe
        $std->CST = '07';
        $std->vBC = null;
        $std->pCOFINS = null;
        $std->vCOFINS = null;
        $std->qBCProd = null;
        $std->vAliqProd = null;

        $nfe->tagCOFINS($std);
    }

}