<?php

namespace Config\Post;

//use Factories\ManualPostProviderFactory;
use Factories\SqlitePostProviderFactory;

class ProviderFactoryConfig {
    /**
     * @return Factories\AbstractFactoryPostProvider
     */
    public static function getPostProviderFactory(){
        //return new ManualPostProviderFactory();
        return new SqlitePostProviderFactory();
    }

}