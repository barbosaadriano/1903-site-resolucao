<?php

namespace Contracts;

interface PostProviderInterface {
    /**
     * @return PostInterface[] //diz para o PhpDoc que retorna Posts
     */
    public function getUltimos();
    /**
     * Aqui poderia ser expecificado getAll, Save, ...
     */

}