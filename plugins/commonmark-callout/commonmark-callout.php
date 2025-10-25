<?php

namespace Formwork\Plugins;

use Composer\Autoload\ClassLoader;
use Formwork\Events\Event;
use Formwork\Plugins\CommonMarkCallout\CalloutExtension;

class CommonMarkCalloutPlugin extends Plugin
{
    public function autoload(): ?ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }
}
