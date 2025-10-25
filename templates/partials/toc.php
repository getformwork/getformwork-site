<ol>
    <?php foreach ($toc ?? (new Formwork\Plugins\TocGenerator\TocGenerator())->generateToc($content ?? $page->content(), $levels ?? null) as $item): ?>
        <li><a href="#<?= $item['id'] ?>" class="toc-link"><?= $item['text'] ?></a></li>
        <?php if (!empty($item['children'])): ?>
            <?= $this->insert('_toc', ['toc' => $item['children']]) ?>
        <?php endif ?>
    <?php endforeach ?>
</ol>