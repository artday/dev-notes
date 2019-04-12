<?php
namespace App\Controllers;

use App\Config\Config;
use App\Database\Database;

class HomeController
{
    private $config;
    private $db;

    public function __construct(Config $config, Database $db)
    {
        $this->config = $config;
        $this->db = $db;

        dump(__CLASS__ . "CREATED");
    }

    public function index()
    {
        return [
            $this->config->get('app')['name'],
            $this->db->connect()
        ];
    }
}