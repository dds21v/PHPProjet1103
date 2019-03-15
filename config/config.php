<?php

use Generic\Renderer\TwigRenderer;

return [
    "rout-dir" => dirname(__DIR__),
    "database_name" => "bdd_mysql_command",
    "database_user" => "php_user_bdd",
    "database_pass" => "ahNvIshqnkqPaindw",


    TwigRenderer::class => function($container) {
        return new TwigRenderer(dirname(__DIR__) . '/templates');
    }

];