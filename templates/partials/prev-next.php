<?php if ($page->get('prevNext', false)): ?>
    <nav class="prev-next">
        <?php if ($prev = $page->siblings()->slice(0, $page->index())->published()->last()): ?>
            <a class="prev-page" href="<?= $prev->uri() ?>">
                <p>&larr; Previous page</p>
                <span class="h4"><mark><?= $prev->title() ?></mark></span>
            </a>
        <?php endif ?>
        <?php if ($next = $page->siblings()->slice($page->index())->published()->first()): ?>
            <a class="next-page" href="<?= $next->uri() ?>">
                <p>Next page &rarr;</p>
                <span class="h4"><mark><?= $next->title() ?></mark></span>
            </a>
        <?php endif ?>
    </nav>
<?php endif ?>
