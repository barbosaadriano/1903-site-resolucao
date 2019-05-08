<?php


namespace Models;

/**
 * Description of CafePingado
 *
 * @author drink
 */
class CafePingado implements Cafe {
    
    private $ingrediente;
    public function __construct($ingredientes) {
        $this->ingrediente = $ingredientes;
    }
    
    public function getDescricao() {
        return "Café com leite! ".$this->ingrediente;
    }

    public function getTitulo() {
        return "Pingado";
    }

}
