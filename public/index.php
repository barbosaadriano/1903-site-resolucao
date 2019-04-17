<?php

chdir(dirname(__DIR__));

require __DIR__."/../vendor/autoload.php";
 
use Site\Home;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RequestContext;

$request = Request::createFromGlobals();

$response = new Response();

$fileLocator = new FileLocator([__DIR__]);
$loader = new PhpFileLoader($fileLocator);
$router = new Router($loader,'../config/config.routes.php',
[], new RequestContext('/'));

$rota = $router->matchRequest($request);

$controllerName = isset($rota['_controller']) ? $rota['_controller'] : '';
$res = "";
 if (is_array($controllerName)) {		
		$controller = $controllerName[0];
		$metodo = $controllerName[1];
		if (class_exists($controller)) {			
			$clazz = new $controller();			
			$res = call_user_func([$clazz,$metodo]);
		}		
 }
 
$twigLoader = new Twig\Loader\FilesystemLoader(
	__DIR__.'/../template/'
);
$twig = new Twig\Environment(
	$twigLoader,
	['cache'=>__DIR__."/../cache/"]
);

$template = $twig->load('base.html');
$html = $template->render(['hello'=>$res]);

$response->setContent($html);
$response->setStatusCode(200);
// header('Content-Type: text/plain');
$response->headers->set('Content-Type','text/html');
$response->send();