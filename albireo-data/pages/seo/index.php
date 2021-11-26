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

    <?php snippet('next-prev', ['', '/']); ?>

/div
