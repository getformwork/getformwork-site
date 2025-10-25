<?= $this->layout('site') ?>

<main>
    <div class="container">
        <article>
            <?php $this->insert('_page-header') ?>
            <?= $page->content() ?>
            <div class="icons">
                <?php foreach (Formwork\Utils\Arr::sort(iterator_to_array(Formwork\Utils\FileSystem::listFiles('panel/assets/icons/svg'))) as $icon): ?>
                    <div class="icon-item">
                        <div><?= $app->panel()->assets()->get('icons/svg/' . $icon)->content() ?></div>
                        <div class="icon-name"><?= Formwork\Utils\FileSystem::name($icon) ?></div>
                    </div>
                <?php endforeach; ?>
        </article>
        <?= $this->insert('_prev-next') ?>
    </div>
</main>
