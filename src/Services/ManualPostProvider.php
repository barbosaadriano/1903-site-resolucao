<?php

namespace Services;

use Contracts\PostProviderInterface;

class ManualPostProvider implements PostProviderInterface
{

    public function getUltimos() {
        $out = [];
        for($i=0; $i<6; $i++) {
            $out[] = [ 
                'titulo' => "Post ".($i+1),
                'conteudo' => "Post para teste ".($i+1),
                'miniatura' => 'https://picsum.photos/300?rand='.rand(0,1000),
                'autor'=> 'fulano de tal'
            ];
        }
        return $out;
    }

}