<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-1-2 small">
                <?= $site->footer() ?>
                <?= $this->insert('_social') ?>
            </div>
            <?php foreach ($site->children()->published()->listed() as $item) : ?>
                <div class="col">
                    <header class="footer-section h6"><a href="<?= $item->uri() ?>"><?= $this->escape($item->get('menu', $item->title())) ?></a></header>
                    <ul class="footer-links">
                        <?php foreach ($item->children()->published()->listed() as $child) : ?>
                            <li><a href="<?= $child->uri() ?>"><?= $this->escape($child->get('menu', $child->title())) ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endforeach ?>
        </div>
</footer>
