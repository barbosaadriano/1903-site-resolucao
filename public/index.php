<?php

chdir(dirname(__DIR__));

if (php_sapi_name()==='cli-server') {
	$path = realpath(__DIR__.parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
	if (__FILE__!==$path && is_file($path)) {
		return false;
	}
	unset($path);
}

require __DIR__."/../vendor/autoload.php";

use Site\Home;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RequestContext;


$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$request = Request::createFromGlobals();

$response = new Response();

$fileLocator = new FileLocator([__DIR__]);
$loader = new PhpFileLoader($fileLocator);
$router = new Router($loader,'../config/config.routes.php',
[], new RequestContext('/'));


try {
	$rota = $router->matchRequest($request);
	$controllerName = isset($rota['_controller']) ? $rota['_controller'] : '';
} catch (Symfony\Component\Routing\Exception\ResourceNotFoundException $exc) {
	$controllerName = ['Site\E404','inicio'];
}
$res = null;
 if (is_array($controllerName)) {		
		$controller = $controllerName[0];
		$metodo = $controllerName[1];
		if (class_exists($controller)) {			
			$clazz = new $controller();			
			if (!method_exists($clazz,$metodo)) {
				throw new \Exception("Método {$metodo} não existe para ".get_class($clazz));
			}
			$res = call_user_func([$clazz,$metodo]);
		} else {
			throw new \Exception("Controller de Erro não Encontrado!");
		}
 }
 
 if ($res!==null && !$res instanceof Contracts\RenderModel) {
	 throw new \Exception("O Controller sempre deve retornar um RenderModel!");
 }

$twigLoader = new Twig\Loader\FilesystemLoader(
	__DIR__.'/../template/'
);
$twig = new Twig\Environment(
	$twigLoader,
	[]
);

$tmplName = 'base';
$vars = [];
if ($res instanceof Contracts\RenderModel) {
	$tmplName = $res->getTemplateName();
	$vars = $res->getVariables();
}

$template = $twig->load($tmplName.'.html');
$html = $template->render($vars);

$response->setContent($html);
$response->setStatusCode(200);
// header('Content-Type: text/plain');
$response->headers->set('Content-Type','text/html');
$response->send();