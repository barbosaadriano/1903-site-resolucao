<?php

namespace Site;

use Helpers\ViewModel;

class Home
{
    public function helloWorld()
    {
        return new ViewModel('base',['hello'=>'Olá Mundão véio']);
    }
}
