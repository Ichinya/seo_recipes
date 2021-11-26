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

function geshi($text)
{
    $fn = SYS_DIR . 'lib/geshi/geshi.php';

    if (file_exists($fn))
        require_once $fn;
    else
        return $text;

    $text = preg_replace_callback('!(geshi)(.*?)(/geshi)!is', function ($m) {
        $pattern = '~^_(\w+)(?:\((.+[^\)])\))?~';
        preg_match($pattern, $m[2], $match);
        $language = $match[1];

        $source = preg_replace($pattern, '', $m[2], 1);
        $geshi = new GeSHi(trim($source), $language);

        parse_str($match[2], $params);
        if (isset($params['lines'])) {
            $geshi->highlight_lines_extra(explode(',', $params['lines']));
        }
//        $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
//        $geshi->start_line_numbers_at(2);
        return $geshi->parse_code();
    }, $text);


    return $text;
}

# end of file
