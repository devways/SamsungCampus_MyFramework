<?php

namespace app\controllers;

use \MonNamespace\Controller\Controller;
use \app\models\indexModel;

class MicController extends Controller {

    public function indexAction() {
        $index = new indexModel();
        $data = $index->getTable();
        var_dump($data);
        
        $this->render("Mic:index", $data);
    }

}