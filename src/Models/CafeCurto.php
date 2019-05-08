<?php

namespace Models;

/**
 * Description of CafeCurto
 *
 * @author drink
 */
class CafeCurto implements Cafe {
    
    
    public function getDescricao() {
        return "Café mais forte em pequena quantidade!";
    }

    public function getTitulo() {
        return "Café curto!";
    }

}
