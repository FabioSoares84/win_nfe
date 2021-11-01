<?php
use app\core\Excecao;
session_start();
require_once __DIR__.'/vendor/autoload.php';
require_once 'app/core/Core.php';
require_once 'app/helper/helper.php';
require_once 'app/helper/datahora.php';
require_once 'app/helper/numero.php';
require_once 'app/helper/rede.php';
require_once 'config/config.php';

date_default_timezone_set(TIMEZONE);

try{
    $core = new Core;
    $core->run();
}catch (Error $e){
    $erro = new Excecao($e);
    $erro->mostrar();
}catch (Exception $e){
    $erro = new Excecao($e);
    $erro->mostrar();
}



