<?php

$isSummary = $page->get('documentation.summary', false);


$baseUri = $page->parent()->template()->name() === 'api'
    ? $page->parent()->uri()
    : $page->uri();

$makedoc = new Formwork\Plugins\MakeDoc\MakeDoc($baseUri, onlySummary: $isSummary);

return ['baseUri' => $baseUri, 'isSummary' => $isSummary, 'makedoc' => $makedoc];
