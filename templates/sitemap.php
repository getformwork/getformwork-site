<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<?= '<?xml-stylesheet type="text/xsl" href="' . $this->assets()->get('xsl/sitemap.xsl')->uri() . '"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($site->descendants()->without($page)->published()->filterBy('routable')->sortBy('relativePath') as $p) : ?>
        <?php if (!in_array($p->route(), (array) $page->get('exclude'))) : ?>
            <url>
                <loc><?= $p->isIndexPage() ? $site->absoluteUri() : $p->absoluteUri() ?></loc>
                <lastmod><?= date('Y-m-d', $p->contentFile()->lastModifiedTime()) ?></lastmod>
            </url>
        <?php endif ?>
    <?php endforeach ?>
</urlset>