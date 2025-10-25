<?php

namespace Formwork\Plugins;

use Composer\Autoload\ClassLoader;

class MakeDocPlugin extends Plugin
{
    public function autoload(): ?ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }
}
