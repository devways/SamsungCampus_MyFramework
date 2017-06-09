<?php

namespace MonNamespace\Controller;

class Controller {

    protected $layout = false;

    function render($filename, $data = null){
        $search = [];
        $replace = [];
        $filename = explode(':', $filename);
        if($data !== null) {
            $i = 0;
            foreach ($data as $key => $value) {
                $search[$i++] = '{{ '.$key.' }}';
                $replace[$i++] = $value;
            }
        }
        if(isset($filename[0]) && isset($filename[1]) && file_exists(ROOT.'app/views/'.$filename[0].'/'.$filename[1].'.html')) {
            ob_start();
            require(ROOT.'app/views/'.$filename[0].'/'.$filename[1].'.html');
            $content_for_layout = ob_get_clean();
            $content_for_layout = str_replace($search, $replace, $content_for_layout);
            if($this->layout == false){
                echo $content_for_layout;
            } else {
                echo 'ok';
                //require(ROOT.'app/views/layout/'.$this->layout.'.php');
            }
        } else {
            echo 'ici';
            require(ROOT.'404.php');
        }
    }
}