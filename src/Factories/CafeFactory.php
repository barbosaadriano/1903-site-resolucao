<?php

namespace Factories;

/**
 * Description of CafeFactory
 *
 * @author drink
 */
abstract class CafeFactory {

    const PINGADO = "1";
    const CURTO = "2";
    const MEU = "3";

    public abstract function metodoDeFabricacao();

    /**
     * @return Models\Cafe
     */
    public function fabricar() {
        return $this->metodoDeFabricacao();
    }

    public static function getFactory($tipo) {
        switch ($tipo) {
            case self::PINGADO:
                return new PingadoFactory();
            case self::CURTO:
                return new CurtoFactory();
            case self::MEU:
                return new MeuCafeFactory();
            default:
                throw new Exception("Tipo de café não existe!");
        }
    }

}
