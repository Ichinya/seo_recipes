<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**

title: YandexMetrika в Mediawiki
description: Устнанавливаем счетчик Яндекс Метрики в шаблон Vector Mediawiki
slug: mediawiki/metrika
layout: seo.php
parser: simple geshi

menu[title]: Я.Метрика в Mediawiki
menu[group]: Mediawiki

-articleClass: pad30

**/

?>

h1(mar0 bg-lime200 pad30-rl pad10-tb) Установка Яндекс.Метрики в шаблон Vector Mediawiki

div(pad30-rl mar30-tb)

    _ На примере, будет показано, как установить счетчика от Яндекс.Метрика, но по аналогии можно установить любой другой счетчик.

    _ Для начала нужен сам код счётчика. В нашем случае заходим в настройки Метрики и копируем код счетчика (нужно выбрать галочку — код в одну строку)

    _ Далее находим в файле @mediawiki\skins\Vector\includes\VectorTemplate.php@ (там, где редактировался <?= a('mediawiki/sape','код sape');?>)

geshi_php
$footerIcons = $this->getFooterIcons( 'icononly' );
/geshi

    _ и сразу после него вставляем строчку. Аккуратнее с кавычками: в начале и в конце кода стоят одинарные кавычки, а в самом коде счетчика только двойные (одинарные нужно поменять на двойные или экранировать - добавить *\* перед ними).

geshi_php
$footerIcons ['yandex_metrika'] = [
'<!-- Yandex.Metrika informer --> КОД МЕТРИКИ <!-- /Yandex.Metrika counter -->'
];
/geshi

    _ Счетчик выведется сам в нужном месте. Довольно просто.

    _ Тут можно вставить сколько угодно счетчиков. Также можно вставлять иконки по параметрами, например, на правила или соглашения:

geshi_php
    $footerIcons ['various_icon'] = [
        [
            [src] => "/resources/assets/poweredby_mediawiki_88x31.png"
            [url] => "https://www.mediawiki.org/"
            [alt] => "Powered by MediaWiki"
            [srcset] => "/resources/assets/poweredby_mediawiki_132x47.png 1.5x, /resources/assets/poweredby_mediawiki_176x62.png 2x"
            [width] => 88
            [height] => 31
        ],
        [
            [src] => "http://evil.com/icon.png"
            [url] => "https://evil.com/"
            [alt] => "Сайт зла"
            [width] => 88
            [height] => 31
        ],
    ];
/geshi

    _ Вот что у меня получилось, на скриншоте в нижнем правом углу.

    <?= img('1.png'); ?>

    <?php snippet('next-prev', ['mediawiki/sape', 'mediawiki/yandex_partner']); ?>

/div
