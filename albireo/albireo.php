<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**
 * (c) Albireo Framework, https://maxsite.org/albireo, 2020
 */

require_once SYS_DIR . 'lib/functions.php';
require_once SYS_DIR . 'lib/html_helpers.php';

//\Cache\Memcached::getInstance()->clear();

createHtaccess(); // создать .htaccess
readPages();      // считать данные всех pages
readGitParams();  // берем параметры из гита
getCurrentUrl();  // получить данные по текущему URL
matchUrlPage();   // подключаемый файл страницы
$slug = str_replace(['.', '/', '\\'], '_', getVal('pageData')['slug']);
$page = getCache($slug);
if (!$page) {
    $page = pageOut();
    setCache($slug . '.txt', $page);
}
echo $page;
//echo \Cache\Memcached::getInstance()->remember(getVal('pageData')['slug'], 86400, fn() => pageOut()); // вывод

if (IS_DEV) {
    $pageData = getVal('pageData');
    pr($pageData);

    $pageFile = getVal('pageFile');
    pr($pageFile);

    $currentUrl = getVal('currentUrl');
    pr($currentUrl);

    $pagesInfo = getVal('pagesInfo');
    pr($pagesInfo);

}
# end of file
