<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models;

/**
 * Description of MeuCafe
 *
 * @author drink
 */
class MeuCafe implements Cafe {
    
    public function getDescricao() {
        return "Café bem forte!";
    }

    public function getTitulo() {
        return "Like a boss!";
    }

}
