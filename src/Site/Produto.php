<?php

namespace Site;

use Factories\CafeFactory;
use Helpers\ViewModel;

class Produto {

    public function listarProdutos() {

        $prods = [];
        for ($index = 0; $index < 3; $index++) {
            $prods[] = CafeFactory::getFactory(rand(1, 3))->fabricar();
        }
        return new ViewModel('produto', ['produtos' => $prods] );
    }

}
