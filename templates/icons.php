<?= $this->layout('site') ?>

<main>
    <div class="container">
        <article>
            <?php $this->insert('_page-header') ?>
            <?= $page->content() ?>
            <div class="icon-filter">
                <input class="icon-filter-input" id="icon-filter" placeholder="Filter icons..." aria-label="Filter icons">
            </div>
            <div class="icons">
                <?php foreach (Formwork\Utils\Arr::sort(iterator_to_array(Formwork\Utils\FileSystem::listFiles('panel/assets/icons/svg'))) as $icon): ?>
                    <div class="icon-item">
                        <div><?= Formwork\Utils\FileSystem::read(Formwork\Utils\FileSystem::joinPaths('panel/assets/icons/svg', $icon)) ?></div>
                        <div class="icon-name"><?= Formwork\Utils\FileSystem::name($icon) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </article>
        <?= $this->insert('_prev-next') ?>
    </div>
</main>