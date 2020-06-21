<?php

namespace classes;

class Helpers {
    static function controllerFuncAutoCaller($ctr)
    {
        $action = explode("/", $_SERVER['REQUEST_URI']);
        if ($action[1] == "api") {
            $controller = new $ctr();
            $func = $action[2];
            if (method_exists($controller, $func)) {
                $controller->$func();
            } else {
                echo "404";
            }
            
        }
    }
}