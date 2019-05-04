<?php

namespace Site;

use Helpers\ViewModel;

class E404
{
    
    public function inicio()
    {
        return new ViewModel('404',['mensagem'=>'Alguém esqueceu de criar esta página!']);
    }

}
