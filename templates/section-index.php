<?= $this->layout('site') ?>

<main>
    <div class="container">
        <article>
            <?php $this->insert('_page-header') ?>
            <?= $page->content() ?>
            <div class="row section-items">
                <?php foreach ($page->children()->published() as $child): ?>
                    <div class="col-1-3">
                        <a href="<?= $child->uri() ?>">
                            <div class="section-item">
                                <h2><?= $child->title() ?></h2>
                                <p><?= $child->description() ?? 'No description available' ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </article>
</main>
