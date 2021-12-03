<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**
 * (c) Albireo Framework, https://maxsite.org/albireo, 2020
 */

require_once SYS_DIR . 'lib/functions.php';
require_once SYS_DIR . 'lib/html_helpers.php';

createHtaccess(); // создать .htaccess
readPages();      // считать данные всех pages
readGitParams();  // берем параметры из гита
getCurrentUrl();  // получить данные по текущему URL
matchUrlPage();   // подключаемый файл страницы
pageOut();        // вывод

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
