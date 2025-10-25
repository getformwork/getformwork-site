<header class="page-header">
    <h1><mark><?= $page->title() ?></mark></h1>
    <?php if ($page->description()): ?>
        <div class="description"><?= $page->description() ?></div>
    <?php endif ?>
</header>
