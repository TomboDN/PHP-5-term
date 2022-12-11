<?php

namespace controller;

use core\Controller;

class UserController extends Controller
{
    public function usersAction()
    {
        $users = $this->model->getUsers();
        $vars = [
            'users' => $users
        ];
        $this->view->render('Список пользователей', $vars);
    }

    public function loginAction()
    {
        $name = $_POST["name"];
        $password = $_POST["password"];
        $theme = $_POST["theme"];
        $lang = $_POST["lang"];
        if (!isset($name) and !isset($password)) {
            header("Location: http://localhost:8081/signin.html");
        }
        $result = $this->model->findByNameAndPassword($name, $password);
        if ($result->num_rows == 1) {
            setcookie('role', $result->fetch_row()[0], time()+60*60*24*1, '/');
            setcookie('login', $name, time()+60*60*24, '/');
            setcookie('theme', $theme, time()+60*60*24, '/');
            setcookie('lang', $lang, time()+60*60*24, '/');
            header("Location: http://localhost:8081");
        } else {
            header("Location: http://localhost:8081/signin.html");
        }
    }

    public function apiAction()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
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
                    "result" => json_encode(array("message" => "Неверный http метод")),
                    "code" => 405
                ];
                echo json_encode(array("message" => "Неверный http метод"));
                break;
        }
        $this->view->json($vars['result'], $vars['code']);
    }
}