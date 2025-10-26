<?= $this->layout('site') ?>

<?php $this->define('api') ?>
<?php if ($page->screenshot()): ?>
    <img class="screenshot" src="<?= $page->screenshot()->toWebp()->uri() ?>">
<?php endif ?>
<?= $page->content() ?>
<?php if (!$isSummary): ?>
    <h2 id="methods">Field methods</h2>
<?php endif ?>
<div class="<?= $this->classes(['documentation', 'summary' => $isSummary]) ?>">
    <?php foreach ($page->get('documentation', []) as $type => $data): ?>
        <?php if ($type === 'classes'): ?>
            <?php foreach ($data as $alias => ['fqcn' => $class, 'includeInherited' => $includeInherited]): ?>
                <?php if ($isSummary): ?>
                    <h2 id="<?= strtolower($alias) ?>"><a href="<?= Formwork\Utils\Path::join([$baseUri, strtolower($alias), '/']) ?>"><?= Formwork\Utils\Str::afterLast($class, '\\') ?></a></h2>
                    <?php $p = $page->children()->find(fn($page) => $page->slug() === strtolower($alias)) ?>
                    <?php if ($p): ?>
                        <?= $p->description() ?>
                    <?php endif ?>
                <?php endif ?>
                <?= $makedoc->generateClassDocumentation($alias, $class, $includeInherited) ?>
            <?php endforeach ?>
        <?php elseif ($type === 'fields'): ?>
            <?php foreach ($data as $alias => ['type' => $type]): ?>
                <?php if ($isSummary): ?>
                    <h2 id="<?= strtolower($alias) ?>"><a href="<?= Formwork\Utils\Path::join([$baseUri, strtolower($alias), '/']) ?>"><?= $alias ?></a></h2>
                    <?php $p = $page->children()->find(fn($page) => $page->slug() === $type) ?>
                    <?php if ($p): ?>
                        <?= $p->description() ?>
                    <?php endif ?>
                <?php endif ?>
                <?= $makedoc->generateFieldDocumentation($alias, $type) ?>
            <?php endforeach ?>
        <?php elseif ($type === 'functions'): ?>
            <?php foreach ($data as ['alias' => $alias, 'resource' => $resource]): ?>
                <?php $functions = Formwork\Cms\App::instance()->getService(Formwork\Services\Container::class)->call(require ROOT_PATH . $resource) ?>
                <?php ksort($functions) ?>
                <div class="methods">
                    <?php foreach ($functions as $name => $closure): ?>
                        <div>
                            <?= $makedoc->generateFunctionDocumentation(new ReflectionFunction($closure), $alias, $name, outputLinks: false) ?>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    <?php endforeach ?>
</div>
<?php $this->end() ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-1-4 show-from-md">
                <nav class="toc">
                    <div class="toc-header h6">Table of Contents</div>
                    <?php $this->insert('_toc', ['content' => $this->block('api'), 'levels' => $page->get('toc.levels', [1, 2, 3])]) ?>
                </nav>
            </div>
            <div class="col-3-4">
                <article>
                    <?php $this->insert('_page-header') ?>
                    <?= $this->block('api') ?>
                </article>
                <?= $this->insert('_prev-next') ?>
                <footer class="page-footer">
                    <?php $this->insert('_suggest-edit') ?>
                </footer>
            </div>
        </div>
    </div>
</main>