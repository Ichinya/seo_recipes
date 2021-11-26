<?php if (!defined('BASE_DIR')) exit('No direct script access allowed'); ?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= getPageDataHtml('title') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= getPageDataHtml('description') ?>">
    <link rel="stylesheet" href="<?= getConfig('assetsUrl') ?>css/berry.css">
    <link rel="stylesheet" href="<?= getConfig('assetsUrl') ?>css/highlightjs.min.css">
    <link rel="shortcut icon" href="<?= getConfig('assetsUrl') ?>images/favicon.svg" sizes="any" type="image/svg+xml">
    <?= implode(getKeysPageData()) ?>
    <?= implode(getKeysPageData('link', '<link rel="[key]" href="[val]">')) ?>
    <?= implode(getKeysPageData('head', '[val]')) ?>
    <?php require LAYOUT_DIR . 'seo-parts/style.php'; ?>
</head>