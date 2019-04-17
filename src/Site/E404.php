<?php

namespace Site;

use Helpers\ViewModel;

class E404
{
    
    public function inicio()
    {
        return new ViewModel('404',['mensagem'=>'A página não foi encontrada!']);
    }

}
