<?php

namespace Config\Post;

use Factories\ManualPostProviderFactory;

class ProviderFactoryConfig {
    /**
     * @return Factories\AbstractFactoryPostProvider
     */
    public static function getPostProviderFactory(){
        return new ManualPostProviderFactory();
    }

}