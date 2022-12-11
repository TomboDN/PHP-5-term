<?php

namespace controller;

use core\Controller;

class ProductController extends Controller
{
    public function productsAction() {
        $products = $this->model->getProducts();
        $vars = [
            'products' => $products
        ];
        $this->view->render('Меню', $vars);
    }
    public function apiAction(){
        $method = $_SERVER['REQUEST_METHOD'];

        switch($method){
            case 'GET':
                $vars = $this->model->read();
                break;
            case 'POST':
                $data = json_decode(file_get_contents("php://input"));
                $vars = $this->model->create($data);
                break;
            case 'PUT':
                $data = json_decode(file_get_contents("php://input"));
                $vars = $this->model->update($data);
                break;
            case 'DELETE':
                $data = json_decode(file_get_contents("php://input"));
                $vars = $this->model->delete($data);
                break;
            default:
                http_response_code(405);
                $vars = [
                    "result"=> json_encode(array("message" => "Неверный http метод")),
                    "code" => 405
                ];
                echo json_encode(array("message" => "Неверный http метод"));
                break;
        }
        $this->view->json($vars['result'], $vars['code']);
    }
}