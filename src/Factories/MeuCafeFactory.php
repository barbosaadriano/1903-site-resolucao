<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Factories;

/**
 * Description of MeuCafeFactory
 *
 * @author drink
 */
class MeuCafeFactory extends CafeFactory {
    
    public function metodoDeFabricacao() {
        return new \Models\MeuCafe();
    }

}
