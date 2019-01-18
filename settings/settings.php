<?php
    $settings = [
        'mysql'=> [
            'host'    => 'chx_mysql',
            'user'    => 'root',
            'pass'    => 'chx',
            'database'=> 'chx',
        ]
    ];

    $requests = [
        'produto'   => 1,
        'categoria' => 1,
    ];

    $routes = [
        '/'          => 'views/home',
        '/login'     => 'views/login',
        '/logout'    => 'views/logout',
        '/produto'   => 'views/produto',
        '/request'   => 'views/request',
        '/cadastro'  => 'views/cadastro',
        '/dashbord'  => 'views/dashbord',
        '/categoria' => 'views/categoria',
    ];

    $templates = [
        'home'      => 'html/home.html',
        'erro'      => 'html/erro.html',
        'login'     => 'html/login.html',
        'sucesso'   => 'html/sucesso.html',
        'produto'   => 'html/produto.html', 
        'cadastro'  => 'html/cadastro.html',
        'dashbord'  => 'html/dashbord.html',
        'categoria' => 'html/categoria.html',
    ];