<?php if (!defined('ZM_PB_VER')) die('Direct access not allowed'); ?>
<!doctype html>
<html lang="<?= $escape($locale) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $escape($text['title']) ?></title>
    <link rel="stylesheet" href="<?= $escape($css) ?>">
</head>
<body>
    <main class="zm-pb-maintenance">
        <?php if ($company !== ''): ?><div class="zm-pb-maintenance-company"><?= $escape($company) ?></div><?php endif; ?>
        <div class="zm-pb-maintenance-label"><?= $escape($text['label']) ?></div>
        <h1><?= $escape($text['title']) ?></h1>
        <p><?= $escape($text['message']) ?></p>
    </main>
</body>
</html>
