<?php

namespace controller;

use core\Controller;

class StatisticsController extends Controller
{
    public function showAction()
    {
        $charts = $this->model->getCharts();
        $fixtures = $this->model->getFixtures();
        $vars = [
            'genderChart' => $charts[0],
            'ageChart' => $charts[1],
            'browsersBar' => $charts[2],
            'photo0' => $fixtures[0],
            'photo1' => $fixtures[1],
            'photo2' => $fixtures[2],
        ];
        $this->view->render('Статистика', $vars);
    }
}