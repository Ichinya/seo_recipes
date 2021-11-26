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
define('ALBIREO_TIME_START', microtime(true));


function img($filename, $alt = null)
{
    $slug = getVal('pageData')['slug'];
    $file = getConfig('uploadsDir') . "$slug/$filename";
    $alt = $alt ?? $filename;
    $img = "<img src=\"$file\" alt='$alt' />";
    return $img;
}

function a($slug, $anchor = null)
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

    $a = '<a href="' . $url . '" title="' . $title . '" target="_blank">' . $anchor . '</a>';
    return $a;
}
