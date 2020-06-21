<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/autoload.php';

use model\Users;
use classes\Helpers;

Helpers::controllerFuncAutoCaller("Controller");

class Controller {
    static function test()
    {
        echo "ALL READY V CLASSE";
    }
}





