<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/autoload.php';

use model\Users;
use model\Unconfrimed;
use classes\Helpers;

Helpers::controllerFuncAutoCaller("Controller");

class Controller {
    static function registry()
    {
        $model = new Unconfrimed();

        $checkExists = $model->select('*')->where([
            "email" => $_POST['email']
        ])->all();


        if (!$checkExists) {
            $result = $model->insert([
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "tel" => $_POST['tel'],
                "prefer_time" => $_POST['prefer-time'],
                "token" => $_POST['email'] . $_POST['tel']
            ]);
            $answer = ["status": "added"];
        } else {
            
        }


        echo json_encode($answer)
    }
}





