<?php
/*
    (c) Parsedown - https://parsedown.org/
    Markdown Syntax: https://spec.commonmark.org/

    Использование в Albireo
    -----------------------
    В настройках страницы укажите

        parser: md
        parser-content-only: 1

    Для сжатия итогогового html-кода:
        compress: 1

*/

function hljs($text)
{
    $text = preg_replace_callback('!(hljs)(.*?)(/hljs)!is', function ($m) {
        $pattern = '~^_(\w+)(?:\((.+[^\)])\))?\s+~';
        preg_match($pattern, $m[2], $match);
        $language = $match[1];

        $source = trim(preg_replace($pattern, '', $m[2], 1));
        return '<pre class="hljs"><code class="language-' . $language . '">' . $source . '</code></pre>';
    }, $text);


    return $text . PHP_EOL . '
<script src="' . getConfig('assetsUrl') . 'js/highlight.min.js"></script>
<script defer>hljs.highlightAll()</script>';
}

# end of file
