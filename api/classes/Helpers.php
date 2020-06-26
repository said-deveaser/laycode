<?php

namespace classes;
use model\Tokens;

class Helpers {
    static function controllerFuncAutoCaller($ctr)
    {
        $action = explode("/", $_SERVER['REQUEST_URI']);
        if ($action[1] == "api") {
            $controller = new $ctr();
            $action[2] = explode("?", $action[2])[0];
            $func = $action[2];
            if (method_exists($controller, $func)) {
                $controller->$func();
            } else {
                var_dump($action[2]);
                echo "404";
            }
            
        }
    }
    static function keyGen()
    {
        $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max=10;
        $size=StrLen($chars)-1;
        $password=null;
        while($max--) {
            $password.=$chars[rand(0,$size)];
        }
        return $password;
    }
    static function checkToken()
    {
        $token = new Tokens();
        if($_COOKIE['email'] == $_SESSION['email'] && $_COOKIE['token'] == $_SESSION['token']){
            $result = $token->select('*')->where([
                "email"=> $_SESSION["email"]
            ])->all();
            if ($result[0]['session_token'] == $_SESSION['token']) {
                return $_SESSION['email'];
            } else {
                $token->delete(['token' => $result[0]['session_token']]);
                return false;
            }
            
        } else {
            $token->delete(["email" => $_SESSION['email']]);
        }
        return false;
    }
}