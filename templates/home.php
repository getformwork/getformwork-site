<?= $this->layout('site') ?>
<main>
    <section class="hero">
        <div class="container">
            <h1><mark>Your site.<br>With simplicity.</mark></h1>
            <p class="headline">Formwork is a <mark>simple, fast and flexible</mark> flat-file CMS that allows you to create and manage websites without the need for a database.</p>
            <div class="hero-actions">
                <a class="hero-button" href="https://github.com/getformwork/formwork/releases/download/<?= $latestRelease ?>/formwork-<?= $latestRelease ?>.zip">Download <strong>Formwork <?= $latestRelease ?></strong></a>
                <div class="version-notes">Released <strong><time datetime="<?= gmdate('Y-m-d\Th:i:s\Z', $latestReleaseTimestamp) ?>"><?= $latestReleaseDaysAgo ?></time></strong> • <a href="https://github.com/getformwork/formwork/blob/<?= $latestRelease ?>/CHANGELOG.md">Changelog</a></div>
            </div>
        </div>
    </section>
    <?php if ($heroImage = $page->heroImage()): ?>
        <div class="hero-image">
            <div class="container">
                <img width="<?= $heroImage->width() ?>" height="<?= $heroImage->height() ?>" src="<?= $heroImage->toWebp()->uri() ?>" style="background-image: url(<?= $heroImage->resize(64)->blur(100)->toWebp()->uri() ?>);">
            </div>
        </div>
    <?php endif; ?>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-1-2 feature">
                    <div class="feature-inner">
                        <h2 class="h3">File-based structure</h2>
                        <p class="tagline">Your site is just folders and text files.</p>
                        <p>Easy to edit, move, version, or back up — no database required.</p>
                        <pre>📂 site
  📂 pages
    📂 about
      📄 page.md
      🖼 portrait.jpg
    📂 index
      📄 index.md</pre>
                    </div>
                </div>
                <div class="col-1-2 feature">
                    <div class="feature-inner">
                        <h2 class="h3">Markdown + YAML for your content</h2>
                        <p class="tagline">Markdown for writing, YAML for data.</p>
                        <p>Keep content clean, portable, and easy to manage.</p>
                        <pre><code class="language-yaml">---
title: About
---</code><code class="language-markdown">
# About

## This is an about page
You can use this page to display information about you or your organization.</code></pre>
                    </div>
                </div>
                <div class="col-1-2 feature">
                    <div class="feature-inner">
                        <h2 class="h3">Flexible structured content</h2>
                        <p class="tagline">Define your own content schemes.</p>
                        <p>With <a href="reference/fields/">20+ field types</a> you can create pages that match your needs.</p>
                        <pre><code class="language-yaml">title: Blog Post

fields:
    summary:
        type: markdown
        label: Summary

    coverImage:
        type: image
        label: Cover image
</code></pre>
                    </div>
                </div>
                <div class="col-1-2 feature">
                    <div class="feature-inner">
                        <h2 class="h3">Intuitive API</h2>
                        <p class="tagline">Work with pages, files, and data effortlessly.</p>
                        <p>A simple, consistent <a href="reference/api/">API</a> for working with pages, files, and site data — in templates or custom code.</p>
                        <pre><code class="language-php">&lt;?php

$posts = $page->children()
            ->published()
            ->reverse()
            ->paginate(5, 1);

return ['posts' => $posts];</code></pre>
                    </div>
                </div>
            </div>
    </section>
</main>