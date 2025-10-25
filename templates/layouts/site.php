<!DOCTYPE html>
<html lang="<?= $site->languages()->current() ?>">

<head>
    <title><?= $page->title() ?> | <?= $site->title() ?></title>
    <?= $this->insert('_meta') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" href="<?= $this->assets()->get('images/logo.svg')->uri(includeVersion: true) ?>">
    <link rel="alternate icon" href="<?= $this->assets()->get('images/logo.png')->uri(includeVersion: true) ?>">
    <link rel="stylesheet" type="text/css" href="<?= $this->assets()->get('css/style.css')->uri(includeVersion: true) ?>">
</head>

<body>
    <?= $this->insert('_menu') ?>
    <?= $this->content() ?>
    <?= $this->insert('_footer') ?>

    <script src="<?= $this->assets()->get('js/script.js')->uri(includeVersion: true) ?>"></script>
    <script src="<?= $this->assets()->get('js/prism.min.js')->uri(includeVersion: true) ?>"></script>
</body>

</html>
