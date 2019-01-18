<?php
    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/templates/engine.php';
    require_once __DIR__.'/settings/settings.php';

    use Route\Router;

    new Router($_SERVER['REQUEST_URI']);