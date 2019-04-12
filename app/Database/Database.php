<?php
namespace App\Database;

use App\Config\Config;

class Database
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;

        dump(__CLASS__ . "CREATED");
    }

    public function connect()
    {
        return $this->config->get('db')['host'];

    }


}