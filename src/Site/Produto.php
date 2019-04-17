<?php

namespace Site;

use Helpers\ViewModel;

class Produto
{
    public function listarProdutos()
    {
        return new ViewModel(
            'produto',
            [
                'produtos'=>[
                    ['titulo'=> 'Produto 1'],
                    ['titulo'=> 'Produto 2'],
                    ['titulo'=> 'Produto 3'],
                ]
            ]
        );
    }
}
