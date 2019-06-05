<?php

//permite deixar relativo o caminho e evitar problemas
chdir(dirname(__DIR__));
// permite carregar arquivos reais
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}
// inclue o autoload do composer
require __DIR__ . "/../vendor/autoload.php";

// declaração das classes utilizadas
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpKernel;

// instanciando o framework Whoops para gerenciar erros
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// instanciando o Request
$request = Request::createFromGlobals();
// instancimando o Response
$response = new Response();
// Criando um file locator para carregar o o arquivo de configurações de rotas
$fileLocator = new FileLocator([__DIR__]);
$loader = new PhpFileLoader($fileLocator);
$router = new Router($loader, '../config/config.routes.php', [], new RequestContext('/'));

// Roteamento, tenta resolver uma rota, e se não encontrar, define um Controller_
// E404 como padrão
// Instancia o controller com base nos parâmetros da rota
$res = null;
try {
    $controllerResolver = new HttpKernel\Controller\ControllerResolver();
    $argumentResolver = new HttpKernel\Controller\ArgumentResolver();
    $request->attributes->add($router->match($request->getPathInfo()));
    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);
    $res = call_user_func_array($controller, $arguments);
  
} catch (Symfony\Component\Routing\Exception\ResourceNotFoundException $exc) {
    $erro = new Site\E404();
    $res = $erro->inicio();
}

// // verifica se o retorno do controller for correto
if ($res !== null && !$res instanceof Contracts\RenderModel) {
    throw new \Exception("O Controller sempre deve retornar um RenderModel!");
}
// instancia o renderizador
$twigLoader = new Twig\Loader\FilesystemLoader(
        __DIR__ . '/../template/'
);
$twig = new Twig\Environment(
        $twigLoader, []
);
// define o template padrão
$tmplName = 'base';
$vars = [];
// verifica o nome da view retornada pelo controller
if ($res instanceof Contracts\RenderModel) {
    $tmplName = $res->getTemplateName();
    $vars = $res->getVariables();
}
// carrega e renderiza o template
$template = $twig->load($tmplName . '.html');
$html = $template->render($vars);
//envia o retorno padra o cliente
$response->setContent($html);
$response->setStatusCode(200);
// header('Content-Type: text/plain');
$response->headers->set('Content-Type', 'text/html');
$response->send();
