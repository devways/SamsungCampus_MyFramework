<?php

namespace my_space;

class Core {
    static public function run() {
        try {
            session_start();
            self::registerAutoload();
            define('URL', '/');
            define('WEBROOT',str_replace('public/index.php','',$_SERVER['SCRIPT_NAME']));
            define('ROOT',str_replace('public/index.php','',$_SERVER['SCRIPT_FILENAME']));

            if(isset($_GET['page'])){
                $params = explode('/', $_GET['page']);
            } else {
                $params[0] = '';
            }
            $controller = !empty($params[0]) ? $params[0] : 'index';
            $action = isset($params[1]) && !empty($params[1]) ? $params[1] : 'index';
             if (!file_exists(ROOT.'app/controllers/'.$controller.'Controller.php')){
                throw new \Exception('Bad File');
             }
            else {
                $controller = 'app\controllers\\'.$controller."Controller";
                $controller = new $controller();
            }
            if (method_exists($controller, $action.'Action')){
                unset($params[0]);
                unset($params[1]);
                call_user_func_array(array($controller, $action.'Action'),$params);
            } else {
                throw new \Exception('Bad File');
            }
        } catch(\Exception $e) {
            if($e->getMessage()== 'Bad File') {
                header("HTTP/1.1 404 Not Found");
                require_once(ROOT.'404.php');
                
            } else {
                header("HTTP/1.1 500 Internal Server Error");
            }
        }
        
    }

    static private function registerAutoload() {
        spl_autoload_register('self::myAutoload');
    }

    static private function myAutoload($class) {
        $class = explode('\\', $class);
        if(isset($class[2]) && file_exists(ROOT.'app/controllers/'.$class[2].'.php')) {
            require_once ROOT."app/controllers/".$class[2].".php";
        } elseif(isset($class[2]) && file_exists(ROOT.'app/models/'.$class[2].'.php')) {
            require_once ROOT."app/models/".$class[2].".php";
        } elseif(isset($class[2]) && file_exists(ROOT.'lib/'.$class[2].'.php')) {
            require_once ROOT."lib/".$class[2].".php";
        }
    }
    
}
