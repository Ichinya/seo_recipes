<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**

title: Sape.RTB в Mediawiki
description: Вставляем код РСЯ в шаблон Vector Mediawiki
slug: mediawiki/sape_rtb
layout: seo.php
parser: simple geshi

menu[title]: Sape.RTB в Mediawiki
menu[group]: Mediawiki
menu[order]: 1

-articleClass: pad30

**/

?>

h1(mar0 bg-lime200 pad30-rl pad10-tb) Sape.RTB в Mediawiki

div(pad30-rl mar30-tb)

    _ Делаем на подобии <?= a('mediawiki/yandex_partner', 'РСЯ в Mediawiki'); ?>

    _ Мы будем работать с двумя файлами: *VectorTemplate.php* и *SkinVector.php*. Оба файла находятся в папке @сайт.рф/skins/Vector/includes@

    _ Для начала работаем с файлом *VectorTemplate.php*. Находим в нем функцию @private function getSkinData()@. В самом начале функции присеваются переменные. Нас тут интересует переменная $out, после её инициализации нужно добавить код:

geshi_php(lines=11,12,13,14)
private function getSkinData() : array {
$contentNavigation = $this->getSkin()->getMenuProps();
$skin = $this->getSkin();
$out = $skin->getOutput();
$title = $out->getTitle();

$mainPageHref = Skin::makeMainPageUrl();
$newTalksHtml = $skin->getNewtalks() ?: null;

// -- ТУТ ВСТАВЛЯЕМ НАШ КОД
$out->addHeadItem('sape_rtb', '<!-- SAPE RTB JS -->
<script async="async" src="https://cdn-rtb.sape.ru/rtb-b/js.js" type="text/javascript">
</script>
<!-- SAPE RTB END -->');
// -- КОНЕЦ ВСТАВКИ

$commonSkinData = $skin->getTemplateData() + [
...
/geshi

    _ Что мы сделали? Мы добавили новую строчку в раздел head сайта. В принципе, тут так и пишем *addHeadItem* - добавить новый элемент head. Первый аргумент, у меня это ya_rtb - это просто идентификатор элемента, это нужно, чтобы при определенных условиях данный item заменить или удалить. Но нас это не интересует, потому что код будет вызываться на всех страницах сайта. Так что придумываем стопроцентно уникальную строчку, например, абракадабру.

    _ Вторым аргументом вписываем саму строчку. Тут просто - код берем из РСЯ. Сейчас он у всех общих, так что можно просто скопировать. С первым файлом закончили.

    _ Приступаем ко второму файлу *SkinVector.php*. Тут немного сложнее. В файле нужно найти функцию @public function getTemplateData()@, работать будем в данном методе.

    _ Сразу в самом начале создаем переменную c кодом вызова, например, @yandeRTBHTML = 'КОД ВЫЗОВА РЕКЛАМЫ'; @. А теперь немного модифицируем то, что выдает функция: @ 'html-body-content' => $yandeRTBHTML . $this->wrapHTML( $title, $out->mBodytext ); @. В итоге получается:

geshi_php(lines=20,21,22,23,24,39)
public function getTemplateData() {
    $out = $this->getOutput();
    $title = $out->getTitle();

    $indicators = [];
    foreach ( $out->getIndicators() as $id => $content ) {
        $indicators[] = [
            'id' => Sanitizer::escapeIdForAttribute( "mw-indicator-$id" ),
            'class' => 'mw-indicator',
            'html' => $content,
        ];
    }

    $printFooter = Html::rawElement(
        'div',
        [ 'class' => 'printfooter' ],
        $this->printSource()
    );

    $sapeRTB = '
<!-- SAPE RTB DIV 240x400 -->
<div id="SRTB_111111"></div>
<!-- SAPE RTB END -->
';

    return [
        'array-indicators' => $indicators,
        'html-printtail' => WrappedString::join( "\n", [
            MWDebug::getHTMLDebugLog(),
            MWDebug::getDebugHTML( $this->getContext() ),
            $this->bottomScripts(),
            wfReportTime( $out->getCSP()->getNonce() )
        ] ) . </body></html>',
        'html-site-notice' => $this->getSiteNotice(),
        'html-userlangattributes' => $this->prepareUserLanguageAttributes(),
        'html-subtitle' => $this->prepareSubtitle(),
        'html-undelete-link' => $this->prepareUndeleteLink() ?: null,
// НИЖЕ ДОБАВЛЯЕМ ЭТУ ПЕРЕМЕННУЮ, НЕ ЗАБЫВАЕМ ТОЧКУ
        'html-body-content' => $sapeRTB . $this->wrapHTML( $title, $out->mBodytext ) . $printFooter,
        'html-after-content' => $this->afterContentHook(),
    ];
}
/geshi

    _ В принципе и всё. Реклама будет показываться под заголовком статьи.

    <?php snippet('next-prev', ['', 'mediawiki/yandex_partner']); ?>

/div
