<?php 

namespace Symfony\Component\Routing\Loader\Configurator;

return function(RoutingConfigurator $routes){
	$routes->add('home','/')
		->controller(['Site\Home','helloWorld']);
	
	$routes->add('produto','/produto')
		->controller(['Site\Produto','listarProdutos']);
};