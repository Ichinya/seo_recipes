<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**
 * Ichi
 */

/**
 * Считать данные из репозитория
 * Результат сохраняется в хранилище в ключе «gitInfo»
 * $pagesInfo = getVal('pagesInfo');
 */
function readGitParams()
{
    //https://api.github.com/repos/ichinya/seo_book/git/refs/tags

    $key = 'gitinfo.txt';

    /** @var \Cache\CacheInterface $cache */
    $cache = Services\Services::getInstance()->get('Cache\Cache');
    // не доступен класс кэширования
    if ($cache !== null && $cache->has($key)) {
        setVal('gitInfo', $cache->get($key)); // сохраняем массив в хранилище
        return; // и выходим
    }

    $url = "https://api.github.com/repos/ichinya/seo_book/git/refs/tags";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "test");
    $r = curl_exec($ch);
    curl_close($ch);

    $response_array = json_decode($r, true);
    $ref = end($response_array);

    $tag = str_replace('refs/tags/', '', $ref['ref']);

    $gitInfo['tag'] = $tag;
    $gitInfo['url'] = 'https://github.com/Ichinya/seo_book';

    // сохраняем массив глобально
    setVal('gitInfo', $gitInfo);

    // сохраняем данные в кэше — файл pagesinfo.txt
    // данные серилизуем

    // когда доступнен класс кэширования, сохраним
    if ($cache !== null) $cache->set('gitinfo.txt', $gitInfo);
}
# end of file
