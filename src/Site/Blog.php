<?php

namespace Site; //Indica o namespace da classe

use Helpers\ViewModel; // Informa ao PHP que utilizaremos_
                       // a classe ViewModel do namespace Helpers
use Config\Post\ProviderFactoryConfig as Pfc;

class Blog  //Apenas o nome da classe, deve ser igual ao Nome do Arquivo
{
    /**
     *  Este método tem a responsabilidade de listar as últimas postagens
     */
    public function ultimasPostagens() 
    {
        // Retorna um novo objeto ViewModel com informarções
        // que serão utilizadas na renderização blog.lista é o nome do template
        // o array são variáveis que serão enviadas para o template
        $provider = Pfc::getPostProviderFactory()->getPostProvider();
        return new ViewModel('blog.lista',['posts'=>$provider->getUltimos()]);
    }

}