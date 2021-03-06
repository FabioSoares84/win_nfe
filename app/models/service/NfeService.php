<?php
namespace app\models\service;

use NFePHP\Common\Certificate;
use NFePHP\NFe\Make;
use NFePHP\NFe\Tools;
use NFePHP\NFe\Common\Standardize;
use Exception;
use app\models\service\NotaFiscalService;
use app\models\service\XmlService;
use NFePHP\DA\NFe\Danfe;
use NFePHP\NFe\Complements;

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
        
        //referente ao Responsável Técnico NT 2018.005
        $std = new \stdClass();
        $std->CNPJ = '27288061000152'; //CNPJ da pessoa jurídica responsável pelo sistema utilizado na emissão do documento fiscal eletrônico
        $std->xContato= 'Fabio Pereira Soares'; //Nome da pessoa a ser contatada
        $std->email = 'faio@wssoft.com.br'; //E-mail da pessoa jurídica a ser contatada
        $std->fone = '67992230567'; //Telefone da pessoa jurídica/física a ser contatada
        $std->CSRT = 'G8063VRTNDMO886SFNK5LDUDEI24XJ22YIPO'; //Código de Segurança do Responsável Técnico
        $std->idCSRT = '01'; //Identificador do CSRT

        $nfe->taginfRespTec($std);
        
        
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
               $retorno->erro = 1;
               $retorno->msg = "XML gerado com sucesso";
               $retorno->msg_erro = ""; 
            }else{
               $retorno->erro = -1;
               $retorno->msg = "Não foi Possível Gerar XML";
               $retorno->msg_erro = $nfe->getErrors(); 
            }
        } catch (Exception $e) {
            i($nfe->getErrors());
        }
        return $retorno;
    }
    
    public static function assinarXml($notafiscal){
        $arr = [
        "atualizacao" => "2021-07-08 09:11:21",
        "tpAmb" => intval($notafiscal->nfe->tpAmb), //intval para pegar valor inteiro
        "razaosocial" => $notafiscal->nfe->em_xNome,
        "cnpj" => $notafiscal->nfe->em_CNPJ,
        "siglaUF" => "MS",
        "schemes" => "PL_009_V4",
        "versao" => '4.00',
        "tokenIBPT" => "",
        "CSC" => "",
        "CSCid" => "",
        "proxyConf" => [
            "proxyIp" => "",
            "proxyPort" => "",
            "proxyUser" => "",
            "proxyPass" => ""
            ]   
        ];
        $retorno = new \stdClass();
        try {
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal->configuracao->certificado_digital); //pega certificado digital
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $notafiscal->configuracao->senha_certificado));
           
            //Lendo o arquivo xml gerado
            $pastaAmbiente = ($notafiscal->nfe->tpAmb=="1") ? "producao" : "homologacao";
            $xml = "Notas/{$pastaAmbiente}/temporarias/{$notafiscal->nfe->chave}-nfe.xml";
            $response = $tools->signNFe(file_get_contents($xml));
            //Tranportar o arquivo assinado para a pasta assinada
            $path_assinada = "Notas/{$pastaAmbiente}/assinadas/{$notafiscal->nfe->chave}-nfe.xml";
            file_put_contents($path_assinada, $response);
            chmod($path_assinada, 0777);
            
            NotaFiscalService::mudarStatus($notafiscal->nfe->id_nfe,4);
            $retorno->erro = -1;
            $retorno->msg = "XML Assinado com sucesso";
            $retorno->msg_erro = ""; 
        } catch (\Exception $e){
            $retorno->erro = 1;
            $retorno->msg = "Erro ao Assinar XML";
            $retorno->msg_erro = $e->getMessage(); 
        } 
        return $retorno;
    }
    
    public static function enviarXml($notafiscal){
        $arr = [
        "atualizacao" => "2021-07-08 09:11:21",
        "tpAmb" => intval($notafiscal->nfe->tpAmb), //intval para pegar valor inteiro
        "razaosocial" => $notafiscal->nfe->em_xNome,
        "cnpj" => $notafiscal->nfe->em_CNPJ,
        "siglaUF" => "MS",
        "schemes" => "PL_009_V4",
        "versao" => '4.00',
        "tokenIBPT" => "",
        "CSC" => "",
        "CSCid" => "",
        "proxyConf" => [
            "proxyIp" => "",
            "proxyPort" => "",
            "proxyUser" => "",
            "proxyPass" => ""
            ]   
        ];
        $retorno = new \stdClass();
        try {
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal->configuracao->certificado_digital); //pega certificado digital
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $notafiscal->configuracao->senha_certificado));
          
            $idLote = str_pad($notafiscal->nfe->nNF, 15, '0', STR_PAD_LEFT);
            
            //Lendo arquivo xml a ser enviado
            $pastaAmbiente = ($notafiscal->nfe->tpAmb=="1") ? "producao" : "homologacao";
            $xml = file_get_contents("Notas/{$pastaAmbiente}/assinadas/{$notafiscal->nfe->chave}-nfe.xml");
            
            //envia o xml para pedir autorização ao SEFAZ
            $resp = $tools->sefazEnviaLote([$xml], $idLote);
            
            //transforma o xml de retorno em um stdClass
            $st = new Standardize();
            $std = $st->toStd($resp);
            if ($std->cStat != 103) {
                //erro registrar e voltar
                $retorno->erro = 1;
                $retorno->msg = "Erro não foi possivel enviar XML";
                $retorno->msg_erro = $std->xMotivo;
                return $retorno;
            }
            $recibo = $std->infRec->nRec;
            NotaFiscalService::salvarRecebido($notafiscal->nfe->id_nfe,$recibo);
            $retorno->erro = -1;
            $retorno->msg = "XML enviado com sucesso";
            $retorno->msg_erro = ""; 
        } catch (\Exception $e) {
            $retorno->erro = 1;
            $retorno->msg = "Erro ao salvar recebimento";
            $retorno->msg_erro = $e->getMessage(); 
        }
        return $retorno;
    }
   
    public static function autorizaXml($notafiscal){
        $arr = [
        "atualizacao" => "2021-07-08 09:11:21",
        "tpAmb" => intval($notafiscal->nfe->tpAmb), //intval para pegar valor inteiro
        "razaosocial" => $notafiscal->nfe->em_xNome,
        "cnpj" => $notafiscal->nfe->em_CNPJ,
        "siglaUF" => "MS",
        "schemes" => "PL_009_V4",
        "versao" => '4.00',
        "tokenIBPT" => "",
        "CSC" => "",
        "CSCid" => "",
        "proxyConf" => [
            "proxyIp" => "",
            "proxyPort" => "",
            "proxyUser" => "",
            "proxyPass" => ""
            ]   
        ];
        $retorno = new \stdClass();
        try {
            //leitura do certificado digital
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal->configuracao->certificado_digital); //pega certificado digital
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $notafiscal->configuracao->senha_certificado));
            //consulta número de recibo
            //$numeroRecibo = número do recíbo do envio do lote
            $xmlResp = $tools->sefazConsultaRecibo($notafiscal->nfe->recibo, intVal($notafiscal->nfe->tpAmb));

            //transforma o xml de retorno em um stdClass
            $st = new Standardize();
            $std = $st->toStd($xmlResp);

            if ($std->cStat=='103') { //lote enviado
                //Lote ainda não foi precessado pela SEFAZ;
                $retorno->erro = 1;
                $retorno->msg = "Não foi possivel fazer a consulta";
                $retorno->msg_erro = "O lote ainda esta sendo processado"; 
                return $retorno;
            }
            if ($std->cStat=='105') { //lote em processamento
                //tente novamente mais tarde
                $retorno->erro = 1;
                $retorno->msg = "Não foi possivel fazer a consulta";
                $retorno->msg_erro = "Lote em processamento, tente mais tarde"; 
                return $retorno;
            }

            if ($std->cStat=='104') { //lote processado (tudo ok)
                if ($std->protNFe->infProt->cStat=='100') { //Autorizado o uso da NF-e
                    $protocolo = $std->protNFe->infProt->nProt;
                     //Lendo arquivo xml a ser assinado
                    $pastaAmbiente = ($notafiscal->nfe->tpAmb=="1") ? "producao" : "homologacao";
                    $xml_assinado = file_get_contents("Notas/{$pastaAmbiente}/assinadas/{$notafiscal->nfe->chave}-nfe.xml");
                    
                    $xml_autorizado = Complements::toAuthorize($xml_assinado, $xmlResp);
                    
                    //Tranportar o arquivo autorizada para a pasta autorizada
                    $path_autorizado = "Notas/{$pastaAmbiente}/autorizadas/{$notafiscal->nfe->chave}-nfe.xml";
                    file_put_contents($path_autorizado, $xml_autorizado);
                    chmod($path_autorizado, 0777);
                    
                    //Salvar na tabela nfe o protrocolo
                    NotaFiscalService::salvarProtocolo($notafiscal->nfe->id_nfe,$protocolo);
                    $retorno->erro = -1;
                    $retorno->msg = "XML Autorizado com sucesso";
                    $retorno->msg_erro = "";
                    return $retorno;
                    
                } elseif (in_array($std->protNFe->infProt->cStat,["110", "301", "302"])) { //DENEGADAS
                   $retorno->erro = 1;
                   $retorno->msg = "Denegado";
                   $retorno->msg_erro = $std->protNFe->infProt->cStat.":".$std->protNFe->infProt->xMotivo;   
                   return $retorno;
                               
                } else { 
                    $retorno->erro = 1;
                    $retorno->msg = "Rejeitada";
                    $retorno->msg_erro = $std->protNFe->infProt->cStat.":".$std->protNFe->infProt->xMotivo;   
                    return $retorno;
                }
            } else { 
                $retorno->erro = 1;
                $retorno->msg = "Rejeitada";
                $retorno->msg_erro = $std->cStat.":".$std->xMotivo; 
                return $retorno;
            }
        } catch (\Exception $e) {
            $retorno->erro = 1;
            $retorno->msg = "Erro ao Consultar";
            $retorno->msg_erro = $e->getMessage(); 
        }
        return $retorno;
    }
    
    public static function cancelarNfe($notafiscal){
        $arr = [
        "atualizacao" => "2021-07-08 09:11:21",
        "tpAmb" => intval($notafiscal->nfe->tpAmb), //intval para pegar valor inteiro
        "razaosocial" => $notafiscal->nfe->em_xNome,
        "cnpj" => $notafiscal->nfe->em_CNPJ,
        "siglaUF" => "MS",
        "schemes" => "PL_009_V4",
        "versao" => '4.00',
        "tokenIBPT" => "",
        "CSC" => "",
        "CSCid" => "",
        "proxyConf" => [
            "proxyIp" => "",
            "proxyPort" => "",
            "proxyUser" => "",
            "proxyPass" => ""
            ]   
        ];
        
        $retorno = new \stdClass();
        try {

//            $certificate = Certificate::readPfx($content, 'senha');
//            $tools = new Tools($configJson, $certificate);
//            $tools->model('55');

            $chave = $notafiscal->nfe->chave;
            $xJust = 'nota emitida em homologação Teste cancelamento';
            $nProt = $notafiscal->nfe->protocolo;
            
            //Ler Certificado
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal->configuracao->certificado_digital); //pega certificado digital
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $notafiscal->configuracao->senha_certificado));
            
            
            
             //Lendo arquivo xml a ser enviado
            $pastaAmbiente = ($notafiscal->nfe->tpAmb=="1") ? "producao" : "homologacao";
            
            
            $response = $tools->sefazCancela($chave, $xJust, $nProt);

            
            $stdCl = new Standardize($response);
            //nesse caso $std irá conter uma representação em stdClass do XML
            $std = $stdCl->toStd();
       
            

            //verifique se o evento foi processado
            if ($std->cStat != 128) {
                $retorno->erro = 1;
                $retorno->msg = "Erro ao Cancelar NFe: ". $std->xMotivo;
                $retorno->msg_erro = $std->cStat . ": ". $std->xMotivo; 
                return $retorno;
                
                
                
                
            } else {
                $cStat = $std->retEvento->infEvento->cStat;
                if ($cStat == '101' || $cStat == '135' || $cStat == '155') {
                    //SUCESSO PROTOCOLAR A SOLICITAÇÂO ANTES DE GUARDAR
                    $xml_cancelado = Complements::toAuthorize($tools->lastRequest, $response);
                    
                    
                    //Tranportar o arquivo para pasta cancelada
                    $path_cancelado = "Notas/{$pastaAmbiente}/canceladas/{$notafiscal->nfe->chave}-nfe.xml";
                    file_put_contents($path_cancelado, $xml_cancelado);
                    chmod($path_cancelado, 0777);
                    
                    
                    //Ler o Arquivo XML a ser enviado
                    $arquivo_aprovado = file_get_contents("Notas/{$pastaAmbiente}/autorizadas/{$notafiscal->nfe->chave}-nfe.xml");
                    
                    $arquivo_aprovado_sem = file_get_contents("Notas/{$pastaAmbiente}/autorizadas/{$notafiscal->nfe->chave}-nfe.xml");
                    
                    $xml_cancelamento = Complements::cancelRegister($arquivo_aprovado, $xml_cancelado);
                    
                    file_put_contents($arquivo_aprovado_sem, $xml_cancelado);
                    chmod($arquivo_aprovado_sem, 0777);
                    
                    
                    $retorno->erro = -1;
                    $retorno->msg = "NFe Cancelada com Sucesso ". $std->xMotivo;
                    $retorno->msg_erro = ""; 
                    return $retorno;
                    //grave o XML protocolado 
                } else {
                    //houve alguma falha no evento 
                    //TRATAR
                }
            }    
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
        
        
        
    }
    
    public static function consultarNfe($notafiscal){
        $arr = [
        "atualizacao" => "2021-07-08 09:11:21",
        "tpAmb" => intval($notafiscal->nfe->tpAmb), //intval para pegar valor inteiro
        "razaosocial" => $notafiscal->nfe->em_xNome,
        "cnpj" => $notafiscal->nfe->em_CNPJ,
        "siglaUF" => "MS",
        "schemes" => "PL_009_V4",
        "versao" => '4.00',
        "tokenIBPT" => "",
        "CSC" => "",
        "CSCid" => "",
        "proxyConf" => [
            "proxyIp" => "",
            "proxyPort" => "",
            "proxyUser" => "",
            "proxyPass" => ""
            ]   
        ];
        
        $retorno = new \stdClass();
        try {
            //Ler Certificado
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal->configuracao->certificado_digital); //pega certificado digital
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $notafiscal->configuracao->senha_certificado));
            
            
            $tools->model('55');

            $chave = $notafiscal->nfe->chave;
            $response = $tools->sefazConsultaChave($chave);

            //você pode padronizar os dados de retorno atraves da classe abaixo
            //de forma a facilitar a extração dos dados do XML
            //NOTA: mas lembre-se que esse XML muitas vezes será necessário, 
            //      quando houver a necessidade de protocolos
            $stdCl = new Standardize($response);
            //nesse caso $std irá conter uma representação em stdClass do XML
            $std = $stdCl->toStd();
       
            
            
            i($std);
            

       
                
                
           
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
        
        
        
    }
    
    
    public static function inuttilizarNfe($notafiscal){
        $arr = [
        "atualizacao" => "2021-07-08 09:11:21",
        "tpAmb" => intval($notafiscal->nfe->tpAmb), //intval para pegar valor inteiro
        "razaosocial" => $notafiscal->nfe->em_xNome,
        "cnpj" => $notafiscal->nfe->em_CNPJ,
        "siglaUF" => "MS",
        "schemes" => "PL_009_V4",
        "versao" => '4.00',
        "tokenIBPT" => "",
        "CSC" => "",
        "CSCid" => "",
        "proxyConf" => [
            "proxyIp" => "",
            "proxyPort" => "",
            "proxyUser" => "",
            "proxyPass" => ""
            ]   
        ];
        $retorno = new \stdClass();
        try {

             //Ler Certificado
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal->configuracao->certificado_digital); //pega certificado digital
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $notafiscal->configuracao->senha_certificado));
        
      

            $nSerie = $notafiscal->nfe->serie;
            $nIni = '50';
            $nFin = '55';
            $xJust = 'Erro de digitação dos números sequencias das notas';
                    
            $response = $tools->sefazInutiliza($nSerie, $nIni, $nFin, $xJust);

            $stdCl = new Standardize($response);
            //nesse caso $std irá conter uma representação em stdClass do XML
            $std = $stdCl->toStd();
     
            i($std);
            
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        
    }
    
    public static function danfe($notafiscal){
        //$xml = file_get_contents(__DIR__ . '/fixtures/mod55-nfe_3.xml');
        //$logo = 'data://text/plain;base64,'. base64_encode(file_get_contents(realpath(__DIR__ . '/../images/tulipas.png')));
        //$logo = realpath(__DIR__ . '/../images/tulipas.png');

        try {
            
            //Lendo arquivo xml a ser assinado
            $pastaAmbiente = ($notafiscal->nfe->tpAmb=="1") ? "producao" : "homologacao";
            $xml_autorizado = file_get_contents("Notas/{$pastaAmbiente}/autorizadas/{$notafiscal->nfe->chave}-nfe.xml");

            $danfe = new Danfe($xml_autorizado);
            $danfe->debugMode(false);
            $danfe->creditsIntegratorFooter('WEBNFe Sistemas - http://www.webenf.com.br');
            $danfe->obsContShow(false);
            $danfe->epec('891180004131899', '14/08/2018 11:24:45'); //marca como autorizada por EPEC
            // Caso queira mudar a configuracao padrao de impressao
            /*  $this->printParameters( $orientacao = '', $papel = 'A4', $margSup = 2, $margEsq = 2 ); */
            // Caso queira sempre ocultar a unidade tributável
            /*  $this->setOcultarUnidadeTributavel(true); */
            //Informe o numero DPEC
            /*  $danfe->depecNumber('123456789'); */
            //Configura a posicao da logo
            /*  $danfe->logoParameters($logo, 'C', false);  */
            //Gera o PDF
            $pdf = $danfe->render();
            header('Content-Type: application/pdf');
            echo $pdf;
        } catch (InvalidArgumentException $e) {
            echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
        }    
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