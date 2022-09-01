---
title: YandexMetrika в Mediawiki
description: Устнанавливаем счетчик Яндекс Метрики в шаблон Vector Mediawiki
---

# Установка Яндекс.Метрики в шаблон Vector Mediawiki

На примере, будет показано, как установить счетчика от Яндекс.Метрика, но по аналогии можно установить любой другой счетчик.

Для начала нужен сам код счётчика. В нашем случае заходим в настройки Метрики и копируем код счетчика (нужно выбрать галочку — код в одну строку)

Далее находим в файле @mediawiki\skins\Vector\includes\VectorTemplate.php@ (там, где редактировался [код Сапы](/mediawiki/sape))

```php
$footerIcons = $this->getFooterIcons( 'icononly' );
```

и сразу после него вставляем строчку. Аккуратнее с кавычками: в начале и в конце кода стоят одинарные кавычки, а в самом коде счетчика только двойные (одинарные нужно поменять на двойные или экранировать - добавить *\* перед ними).

```php
$footerIcons ['yandex_metrika'] = [
'<!-- Yandex.Metrika informer --> КОД МЕТРИКИ <!-- /Yandex.Metrika counter -->'
];
```

Счетчик выведется сам в нужном месте. Довольно просто.

Тут можно вставить сколько угодно счетчиков. Также можно вставлять иконки по параметрами, например, на правила или соглашения:

```php
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
```

Вот что у меня получилось, на скриншоте в нижнем правом углу.

:image{src=1.png}
