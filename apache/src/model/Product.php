<?php

namespace model;

use core\Model;

class Product extends Model
{
    public function getProducts(): array
    {
        $result = $this->db->query(/** @lang MySQL */ "SELECT * FROM products");
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
            !empty($data->volume) &&
            !empty($data->description) &&
            !empty($data->price)
        ) {
            $data->name = htmlspecialchars(strip_tags($data->name));
            $data->volume = htmlspecialchars(strip_tags($data->volume));
            $data->description = htmlspecialchars(strip_tags($data->description));
            $data->price = htmlspecialchars(strip_tags($data->price));
            $query = /** @lang MySQL */
                "INSERT INTO products (name, volume, description, price) VALUES (\"$data->name\", \"$data->volume\", \"$data->description\", \"$data->price\")";
            $this->db->query($query);
            return array("result" => json_encode("Товар был создан.", JSON_UNESCAPED_UNICODE), "code" => 201);
        } else {
            return array("result" => json_encode("Невозможно создать товар", JSON_UNESCAPED_UNICODE), "code" => 503);
        }

    }

    public function read(): array
    {
        $query = /** @lang MySQL */
            "SELECT * FROM products";
        $result = $this->db->query($query);
        if (!empty($result)) {
            return array("result"=> json_encode($result, JSON_UNESCAPED_UNICODE), "code" => 200);
        }
        else {
            return array("result"=> json_encode("Товары не найдены.", JSON_UNESCAPED_UNICODE), "code" => 404);
        }
    }

    public function update($data): array
    {
        $data->id = htmlspecialchars(strip_tags($data->id));
        $data->name = htmlspecialchars(strip_tags($data->name));
        $data->volume = htmlspecialchars(strip_tags($data->volume));
        $data->description = htmlspecialchars(strip_tags($data->description));
        $data->price = htmlspecialchars(strip_tags($data->price));
        $query = /** @lang MySQL */
            "UPDATE products SET name=\"$data->name\", volume=\"$data->volume\", description=\"$data->description\", price=\"$data->price\" WHERE id=$data->id";
        $this->db->query($query);
        if (!empty($data->name) && !empty($data->password) && !empty($data->id)) {
            return array("result"=> json_encode("Товар был обновлён", JSON_UNESCAPED_UNICODE), "code" => 200);
        }
        else {
            return array("result"=> json_encode("Невозможно обновить товар", JSON_UNESCAPED_UNICODE), "code" => 503);
        }
    }

    public function delete($data): array
    {
        $data->id = htmlspecialchars(strip_tags($data->id));
        $query = /** @lang MySQL */
            "DELETE FROM products WHERE id=$data->id";
        $this->db->query($query);
        return array("result"=> json_encode("Товар был удален", JSON_UNESCAPED_UNICODE), "code" => 200);
    }
}