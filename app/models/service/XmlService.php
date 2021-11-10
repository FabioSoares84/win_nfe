<?php
namespace app\models\service;


class XmlService{

    public static function salvar($id_nfe, $xml){
       $tem = Service::get("xml", "$id_nfe", $id_nfe);
       if($tem){
           Service::editar(["id_nfe"=>$id_nfe,"xml"=>$xml], "id_nfe", "xml");
       }else{
           Service::inserir(["id_nfe"=>$id_nfe,"xml"=>$xml],"xml");
       }
    }
    
   
   

}