<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**

title: Sape в Mediawiki
description: Вставляем код Sape в шаблон Vector Mediawiki
slug: mediawiki/sape
layout: seo.php
parser: simple geshi

menu[title]: Sape в Mediawiki
menu[group]: Mediawiki

-articleClass: pad30

**/

?>

h1(mar0 bg-lime200 pad30-rl pad10-tb) Sape в Mediawiki

div(pad30-rl mar30-tb)

    _ Я давно хотел обновить тему для сайта на движке MediWiki. Мне нравится тема Vector, но как добавить туда рекламный код не понимал. Поиске в интернете с периодичностью пару в пару месяцев не давал результатов.

    _ Так что я решил потратить время и разобраться с этим вопросом. Но перво-наперво я скачал новый скин из движка. Пришлось обновить движок до последней версии. Выяснилось, что теперь нужно обновить PHP. Ладно это не сложно, благо, что подобное делается в несколько кликов (сайт крутиться на хостинге от Reg.ru, но это также легко сделать в любой панели ISPManagaer). В любом случае, проверяйте версии, которые требуется для установки или обновления сайта. Меня оправдывает, что есть свежий BackUp, а посещаемость сайта около 10 человек в день. Это тестовый сайт. На нем протестирую и буду обновлять второй, где посещаемость гораздо выше.

    _ Итак, приступаем. Устанавливать я буду рекламный блок от Sape. Но от других бирж не сильно отличается установка.

    _ Первым делом прописываем инициализацию кода Sape, для это нужно в файл настроек LocalSettings.php, в конец файла дописать код с сайта (не забудьте исправить пользователя Sape на свой):

geshi_php
# SAPE
global $sape;
if (!defined('_SAPE_USER')){
    define('_SAPE_USER', 'КОД ПОЛЬЗОВАТЕЛЯ SAPE');
}
$o[ 'force_show_code' ] = true;
require_once ("$IP".'/'._SAPE_USER.'/sape.php');
$o['charset'] = 'UTF-8';
$sape = new SAPE_client($o);
unset($o);
/geshi

    _ В корень сайта закидываем папку от SAPE (папка имеет кучу случайных символов), в ней два файла sape.php и .htaccess

    _ А теперь самое сложно. Заходим в папку @mediawiki\skins\Vector\includes\VectorTemplate.php@

geshi_php
private function buildSidebar() : array {
// находим данную функцию

// и перед циклом надо добавить свой код
    foreach ( $portals as $name => $content ) {
/geshi

То есть должно получиться что-то подобное

geshi_php(lines=8,9,10,11,12)
    private function buildSidebar() : array {
        $skin = $this->getSkin();
        $portals = $skin->buildSidebar();
        $props = [];
        $languages = null;
        // Render portals

        // ДОБАВЛЯЕМ СЮДА
        global $sape;
            $portals['SAPE'] = [
                $sape->return_block_links()
            ];
        foreach ( $portals as $name => $content ) {
/geshi

    _ чуть ниже находим *swith*, в который добавляем прямо перед @case ‘SEARCH’@:

geshi_php
    case 'SAPE':
        $html = $content[0];
        $content = [];
        wfDeprecated(
            "`content` field in portal $name must be array."
            . "Previously it could be a string but this is no longer supported.",
            '1.35.0'
        );
        $portal = $this->getMenuData(
            $name, $content, self::MENU_TYPE_PORTAL
        );

        if ( $html ) {
            $portal['class'] = 'vector-menu vector-menu-portal portal';
            $portal['html-items'] .= $html;
        }
        $props[] = $portal;
    break;
/geshi

    _ Вот и всё. Код должен выводиться.

    _ В принципе тут можно любой html код выводить, нужно просто добавить перед циклом *foreach* @$portals['индификатор'] = HTML_CODE@

    _ и в *SWITH* нужно добавить его обработку (просто скопировать CASE 'SAPE', где просто меняем SAPE на наш идентификатор).

    <?php snippet('next-prev', ['', 'mediawiki/sape_rtb']); ?>

/div
