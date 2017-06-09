<?php

namespace app\controllers;

use \MonNamespace\Controller\Controller;
use \app\models\indexModel;

class userController extends Controller {
    public function indexAction() {
        echo "index in user";
        $index = new indexModel();
        $index->salut();
    }

    public function notindexAction() {
        echo "notIndex in user";
    }
}