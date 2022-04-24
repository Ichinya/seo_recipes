<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**
 * (c) Albireo Framework, https://maxsite.org/albireo, 2020
 */

/**
 * Начальное время для получения статистики
 *
 * Узнать затраченное время:
 * $time = number_format(microtime(true) - ALBIREO_TIME_START, 6) . 'sec';
 */
if (!defined('ALBIREO_TIME_START'))
    define('ALBIREO_TIME_START', microtime(true));


function img($filename, $alt = null): string
{
    $slug = getVal('pageData')['slug'];
    $file = getConfig('uploadsDir') . "$slug/$filename";
    if (!file_exists(str_replace(SITE_URL, BASE_DIR, $file)))
        return '';
    $alt = $alt ?? $filename;
    return "<img src=\"$file\" alt='$alt' />";
}

function a($slug, $anchor = null): string
{
    $pagesInfo = getVal('pagesInfo');

    $title = null;
    $url = $slug;

    foreach ($pagesInfo as $page) {
        if ($page['slug'] == $slug) {
            $title = isset($page['title']) ? htmlspecialchars($page['title']) : htmlspecialchars($page['slug']);
            $url = SITE_URL . $page['slug'] . STATIC_EXT;
            break;
        }
    }

    $anchor = $anchor ?? $title ?? $slug;
    $title = $title ?? $anchor ?? '';

    return '<a href="' . $url . '" title="' . $title . '" target="_blank">' . $anchor . '</a>';
}
