<?php

namespace Formwork\Plugins;

use Composer\Autoload\ClassLoader;
use Formwork\Debug\Debug;
use Formwork\Events\Event;
use Formwork\Plugins\Plugin;
use Formwork\Plugins\TocGenerator\TocGenerator;
use Formwork\Pages\Page;

class TocGeneratorPlugin extends Plugin
{
    public function autoload(): ?ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    public function onPageRender(Event $event): void
    {
        /**
         * @var Page $page
         */
        $page = $event->get('page');
        if ($page->get('toc.autoGenerate', true) === false) {
            return;
        }
        $event->set('data.toc', (new TocGenerator())->generateToc($page->content()));
    }
}
