<?php $this->layout('site') ?>

<main>
    <div class="container">
        <article>
            <header class="page-header">
                <h1 class="page-title"><mark>Search results</mark></h1>
            </header>
            <?php if (count($results) < 1) : ?>
                <p>No results found<?php if (!empty($query)): ?> for “<strong><?= $this->escape($query) ?></strong>”<?php endif ?>. Please try a different search term.</p>
            <?php else : ?>
                <p>Found <?= count($results) ?> result<?= count($results) === 1 ? '' : 's' ?> for “<strong><?= $this->escape($query) ?></strong>”:</p>
                <div class="search-results">
                    <?php foreach ($results as $result) : ?>
                        <a class="search-result-link" href="<?= $result->uri() ?>">
                            <div class="search-result-item">
                                <h3 class="search-result-title"><?= $this->escape($result->title()) ?></h3>
                                <?php if ($result->excerpt()) : ?>
                                    <p class="search-result-excerpt"><?= $result->excerpt() ?></p>
                                <?php endif ?>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </article>
    </div>
</main>