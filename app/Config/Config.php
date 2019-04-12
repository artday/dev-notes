<?php

namespace App\Config;

class Config
{
    public function __construct()
    {
        dump(__CLASS__ . "CREATED");
    }

    private $config =[
        'app' => [
            'name' => 'Our Container',
        ],
        'db' => [
            'host' => '127.0.0.1',
            'database' => 'container'
        ]
    ];


    public function get($key, $default = null)
    {
        return $this->config[$key];
    }

}