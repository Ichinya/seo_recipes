<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**

title: Sitemap для Mediawiki
description: Sitemap для Mediawiki

slug: mediawiki/sitemap

layout: seo.php
parser: simple

menu[title]: Sitemap для Mediawiki
menu[group]: Mediawiki

-articleClass: pad30

**/

?>

h1(mar0 bg-lime200 pad30-rl pad10-tb) Sitemap для Mediawiki

div(pad30-rl mar30-tb)

    _ Небольшое дополнение к движку MediaWiki, которая создает rss ленты. В основном, это нужно для добавления в <?= a('mediawiki/turbo','ЯндексТурбо') ?>. Скачать можно с <?= a('https://github.com/Ichinya/yandex_turbo_for_mediawiki', 'GitHub') ?>

    _ Начиная с версии 1.2 появилась возможность построения sitemap

    _ Шаблон сделан для webmaster Яндекса. Доступ к карте сайте получается по ссылке:

    div(mar10-b)
        @https://site.ru/turbo/?template=sitemap@
    /div

    <?= img('1.png'); ?>

    h2 На счет оптимизации

    _ Я проверяю на своем небольшом сайте на движке mediawiki, на котором примерно 100 статей. Скорость вывода страницы sitemap — примерно 600мс.

    <?= img('2.png'); ?>

    <?php snippet('next-prev', ['', '']); ?>

/div
