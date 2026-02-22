<?php

namespace Formwork\Plugins;

use Composer\Autoload\ClassLoader;

class CommonMarkCalloutPlugin extends Plugin
{
    public function autoload(): ?ClassLoader
    {
        $classLoader = new ClassLoader();
        $classLoader->addPsr4('Formwork\Plugins\CommonMarkCallout\\', $this->path() . '/src/');
        return $classLoader;
    }
}
