<?php

namespace Factories;

/**
 * Description of PingadoFactory
 *
 * @author drink
 */
class PingadoFactory extends CafeFactory {

    public function metodoDeFabricacao() {
        $ing = " esse é para os fracos! ";
        return new \Models\CafePingado($ing);
    }

}
