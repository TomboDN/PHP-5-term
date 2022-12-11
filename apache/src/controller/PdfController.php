<?php

namespace controller;

use core\Controller;

class PdfController extends Controller
{
    public function showAction() {
        $this->view->render('PDF файлы');
    }

    public function uploadAction(){
        $result = $this->model->uploadFile();
        $vars = ["result" => $result];
        $this->view->render("Страница после загрузки", $vars);
    }
}