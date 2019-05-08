<?php

namespace Factories;

/**
 * Description of CurtoFactory
 *
 * @author drink
 */
class CurtoFactory extends CafeFactory {

    public function metodoDeFabricacao() {
        return new \Models\CafeCurto();
    }

}
