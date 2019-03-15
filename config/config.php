<?php

use Generic\Database\Connection;
use Generic\Renderer\TwigRenderer;

return [
    "rout-dir" => dirname(__DIR__),
    "database_name" => "mysql:host=localhost;dbname=bdd_mysql_command",
    "database_user" => "php_user_bdd",
    "database_pass" => "ahNvIshqnkqPaindw",


    TwigRenderer::class => function($container) {
        return new TwigRenderer(dirname(__DIR__) . '/templates');
    },

    Connection::class =>function($container) {
        return new Connection(
            $container->get("database_name"),
            $container->get("database_user"),
            $container->get("database_pass")
        );
    },

];