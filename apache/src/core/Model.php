<?php

namespace core;


use api\config\Database;

abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}