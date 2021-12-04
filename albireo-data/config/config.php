<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**
 * (c) Albireo Framework, https://maxsite.org/albireo, 2020
 */

// конфигурация для обычного вывода страниц

$config = [
    // url-путь к assets
    'assetsUrl' => SITE_URL . 'assets/',

    'uploadsDir' => SITE_URL . 'uploads/',

    // шаблон по умолчанию
    'layout' => 'main.php',

    // каталоги, где ещё могут располагаться страницы, кроме DATA_DIR
    // указывается полный путь
    // 'dirsForPages' => [BASE_DIR . 'my-pages'],

    // отключить кэширование — только для отладки
    // 'noCache' => true,

    'memcached' => ['address' => '127.0.0.1', 'port' => 11211],
];

if (IS_DEV) {
    $config['noCache'] = true;
}

return $config;
# end of file
