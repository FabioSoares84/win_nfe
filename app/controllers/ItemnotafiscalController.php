<?php

namespace app\controllers;

use app\core\Controller;
use app\models\dao\ItemNotaFiscalDao;


class ItemnotafiscalController extends Controller {
    
    public static function existeItem($id_nfe, $id_produto){
        $dao = new ItemNotaFiscalDao();
        
        return $dao->existeItem($id_nfe, $id_produto);
        
    }
}
