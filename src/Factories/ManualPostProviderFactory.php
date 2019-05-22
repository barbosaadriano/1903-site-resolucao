<?php

namespace Factories;

use \Services\ManualPostProvider;

class ManualPostProviderFactory extends AbstractFactoryPostProvider 
{

    public function create(){
        return new ManualPostProvider();
    }

}