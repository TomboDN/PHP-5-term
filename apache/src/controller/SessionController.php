<?php

namespace controller;

use core\Controller;

class SessionController extends Controller
{

    public function infoAction(){
        $this->view->render("Информация о сессии");
    }
}