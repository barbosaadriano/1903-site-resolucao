<?php

namespace Factories;

use \Services\SqlitePostProvider;

class SqlitePostProviderFactory extends AbstractFactoryPostProvider 
{

    public function create(){
        return new SqlitePostProvider();
    }

}