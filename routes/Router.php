<?php

namespace Route;

use Utils\Erro;
use Utils\Method;

class Router{
    private $request;
    
	public function __construct($request){
		global $routes;

		// se a rota requisitada não existir exibe o erro 404
		if(!isset($routes[$request]))
			Erro::_404();

		$this->get($request, $routes[$request]);

    }
    
	public function get($route, $file){
		// verifica se existem métodos passados via get
		if(stristr($route, "?")){
			// Por enquanto, não fazemos nada com isso...
			// e do jeito que está não funciona, pois a verificação
			// da url está sendo feita antes da chamada dessa função
			print_r("Foram passados parametros via get");

			$get = explode("?", trim($route, "/"));

			$route = $get[0];
			$get = $get[1];
		}

		$url  = explode("/", trim($route, "/"));
		$uri  = array_shift($url);
		$args = $url;

		// print_r($args);

		// verifica se existe parâmetros
		// if(is_array($args) && !empty($args))
		// 	echo "temos argumentos";

		// veriifica se existe algum parâmetro passado
		if(!empty($_REQUEST))
			$args = $_REQUEST;

		if($uri == trim($route, "/")){
			session_start();
			
			require_once $file . '.php';

			new Method($args);
		}
	}
}