<?php

use App\Config\Config;
use App\Database\Database;
use App\Controllers\HomeController;

require_once __DIR__ . '/vendor/autoload.php';

$container = new \App\Container\Container;

/*  Add singleton Instance of Db

    $container->singleton(Config::class, function (){
        return new App\Config\Config;
    });
*/

dump(
    $container->get(HomeController::class)->index()
);
