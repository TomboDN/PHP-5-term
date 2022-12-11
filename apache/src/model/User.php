<?php

namespace model;

use core\Model;

class User extends Model
{
    public function getUsers(): array
    {
        $result = $this->db->query(/** @lang MySQL */ "SELECT * FROM users");
        $arr = array();
        foreach ($result as $row) {
            $arr[] = $row;
        }
        return $arr;

    }

    public function create($data): array
    {
        if (
            !empty($data->name) &&
            !empty($data->password) &&
            !empty($data->role)
        ) {
            $data->name = htmlspecialchars(strip_tags($data->name));
            $data->password = htmlspecialchars(strip_tags($data->password));
            $data->role = htmlspecialchars(strip_tags($data->role));
            $query = /** @lang MySQL */
                "INSERT INTO users (name, password, role) VALUES (\"$data->name\", \"$data->password\", \"$data->role\")";
            $this->db->query($query);
            return array("result" => json_encode("Пользователь был создан.", JSON_UNESCAPED_UNICODE), "code" => 201);
        } else {
            return array("result" => json_encode("Невозможно создать пользователя", JSON_UNESCAPED_UNICODE), "code" => 503);
        }
    }

    public function read(): array
    {
        $query = /** @lang MySQL */
            "SELECT * FROM users";
        $result = $this->db->query($query);
        if (!empty($result)) {
            return array("result"=> json_encode($result, JSON_UNESCAPED_UNICODE), "code" => 200);
        }
        else {
            return array("result"=> json_encode("Пользователи не найдены.", JSON_UNESCAPED_UNICODE), "code" => 404);
        }
    }

    public function findByNameAndPassword($name, $password){
        $name = htmlspecialchars(strip_tags($name));
        $password = htmlspecialchars(strip_tags($password));
        return $this->db->query(/** @lang MySQL */ "SELECT role from users where name='$name' and password='$password'");
    }

    public function update($data): array
    {
        $data->name = htmlspecialchars(strip_tags($data->name));
        $data->password = htmlspecialchars(strip_tags($data->password));
        $data->role = htmlspecialchars(strip_tags($data->role));
        $data->id = htmlspecialchars(strip_tags($data->id));
        $query = /** @lang MySQL */
            "UPDATE users SET name=\"$data->name\", password=\"$data->password\", role=\"$data->role\" WHERE id=$data->id";
        $this->db->query($query);
        if (!empty($data->name) && !empty($data->password) && !empty($data->id)) {
            return array("result"=> json_encode("Пользователь был обновлён", JSON_UNESCAPED_UNICODE), "code" => 200);
        }
        else {
            return array("result"=> json_encode("Невозможно обновить пользователя", JSON_UNESCAPED_UNICODE), "code" => 503);
        }
    }

    public function delete($data): array
    {
        $data->id = htmlspecialchars(strip_tags($data->id));
        $query = /** @lang MySQL */
            "DELETE FROM users WHERE id=$data->id";
        $data->db->query($query);
        return array("result"=> json_encode("Пользователь был удален", JSON_UNESCAPED_UNICODE), "code" => 200);
    }
}