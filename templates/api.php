<?= $this->layout('site') ?>

<?php $this->define('api') ?>
<div class="<?= $this->classes(['documentation', 'summary' => $isSummary]) ?>">
    <?php foreach ($page->get('documentation', []) as $type => $data): ?>
        <?php if ($type === 'classes'): ?>
            <?php foreach ($data as $alias => ['fqcn' => $class, 'includeInherited' => $includeInherited]): ?>
                <?php $meta = $makedoc->getClassMeta($class) ?>
                <?php if ($isSummary): ?>
                    <h2 id="<?= strtolower($alias) ?>" class="<?= $this->classes(['is-new' => $meta['since']]) ?>"><a href="<?= Formwork\Utils\Path::join([$baseUri, strtolower($alias), '/']) ?>"><?= Formwork\Utils\Str::afterLast($class, '\\') ?></a></h2>
                    <?php $p = $page->children()->find(fn($page) => $page->slug() === strtolower($alias)) ?>
                    <?php if ($p): ?>
                        <?= $p->description() ?>
                    <?php endif ?>
                <?php endif ?>
                <?php if ($meta['since']): ?>
                    <p><span class="badge badge-yellow">Since <?= $meta['since'] ?></span></p>
                <?php endif ?>
                <?= $makedoc->generateClassDocumentation($alias, $class, $includeInherited, $data[$alias]['excludeMethods'] ?? []) ?>
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
                <?php if ($page->get('toc.autoGenerate', true)): ?>
                    <nav class="toc">
                        <div class="toc-header h6">Table of Contents</div>
                        <?php $this->insert('_toc', ['content' => $this->block('api'), 'levels' => $page->get('toc.levels', [1, 2, 3])]) ?>
                    </nav>
                <?php endif ?>
            </div>
            <div class="col-3-4">
                <article>
                    <?php $this->insert('_page-header') ?>
                    <?= $page->content() ?>
                    <?= $this->block('api') ?>
                </article>
                <?= $this->insert('_prev-next') ?>
            </div>
        </div>
</main>