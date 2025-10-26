<?= $this->layout('site') ?>

<?php $this->define('main') ?>
<?php $this->insert('_page-header') ?>
<article>
    <?= $page->content() ?>
</article>
<?= $this->insert('_prev-next') ?>
<footer class="page-footer">
    <?php $this->insert('_suggest-edit') ?>
</footer>
<?php $this->end() ?>

<main>
    <div class="container">
        <?php if ($page->get('toc.visible', true)) : ?>
            <div class="row">
                <div class="col-1-4 show-from-md">
                    <nav class="toc">
                        <div class="toc-header h6">Table of Contents</div>
                        <?php $this->insert('_toc') ?>
                    </nav>
                </div>
                <div class="col-3-4">
                    <?= $this->block('main') ?>
                </div>
            </div>
        <?php else : ?>
            <?= $this->block('main') ?>
        <?php endif ?>
    </div>
</main>