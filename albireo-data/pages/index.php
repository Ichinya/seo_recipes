<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**

title: SEO Book
description: Сайт с разными рецептами по продвижению
slug: /
layout: seo.php
parser: simple

menu[title]: Главная
menu[group]:
menu[order]: 0

-articleClass: pad30

**/

?>

h1(mar0 bg-lime200 pad30-rl pad10-tb) SEO Book

div(pad30-rl mar30-tb)

    _ Книга рецептов по SEO:
    ul
        * Теория, где можно узнать некоторые вещи, например, про санкции поисковых систем
        * Различные практики по поисковой оптимизации
        * Инструкции по установке и настройки. Например, установка рекламы РСЯ
    /ul

    _ Также свои статьи можно добавлять на <?= a('https://github.com/Ichinya/seo_book', 'git'); ?>. Статьи будут добавлены с подписью автора и его ссылкой.

    <?php snippet('next-prev', ['', '']); ?>

/div
