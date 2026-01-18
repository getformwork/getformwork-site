<nav class="menu">
    <div class="container">
        <a class="menu-header" href="<?= $site->uri() ?>"><img src="<?= $this->assets()->get('images/logo.svg')->uri() ?>" class="logo"><?= $this->escape($site->title()) ?></a>
        <div class="menu-toggle">
            <button type="button" class="button menu-toggle" data-toggle="main-menu" aria-expanded="false"><?= $this->assets()->get('icons/svg/bars.svg')->content() ?></button>
        </div>
        <div class="menu-list menu-collapse" id="main-menu">
            <?php foreach ($site->children()->published()->listed() as $item) : ?>
                <a class="<?= $this->classes(['menu-item', 'active' => $item->isCurrent() || $site->currentPage()?->isDescendantOf($item)]) ?>" href="<?= $item->uri() ?>"><?= $this->escape($item->get('menu', $item->title())) ?></a>
            <?php endforeach ?>
            <div class="menu-search">
                <form class="search-form" action="<?= $site->uri('search') ?>" method="get" role="search">
                    <input id="menu-search-input" class="search-input" type="text" name="q" placeholder="Search…" value="<?= isset($_GET['q']) ? $this->escape($_GET['q']) : '' ?>">
                    <button type="submit" class="button search-button"><?= $this->assets()->get('icons/svg/search.svg')->content() ?></button>
                </form>
            </div>
        </div>
    </div>
</nav>