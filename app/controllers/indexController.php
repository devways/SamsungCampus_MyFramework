<?php

namespace app\controllers;

use \MonNamespace\Controller\Controller;
use \app\models\indexModel;

class indexController extends Controller {

    public function indexAction() {
        $indexModel = new indexModel;
        $data = $indexModel->read('events', 'category_event = ?', ['overwatch']);
        $this->render('Index:index', $data);
    }

    public function notindexAction() {
        $indexModel = new indexModel;
        $data = $indexModel->read('events', 'category_event = ?', ['paladin']);
        $this->render('Index:index', $data);
    }
}