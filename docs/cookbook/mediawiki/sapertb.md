---
title: Sape.RTB в Mediawiki
description: Вставляем код РСЯ в шаблон Vector Mediawiki
icon: fa-solid fa-s
category: Mediawiki
tag: [Mediawiki, Sape, Sape RTB]
---

# Sape.RTB в Mediawiki

Делаем на подобии [РСЯ в Mediawiki](/mediawiki/yandex_partner).

Мы будем работать с двумя файлами: *VectorTemplate.php* и *SkinVector.php*. Оба файла находятся в папке @сайт.рф/skins/Vector/includes@

Для начала работаем с файлом *VectorTemplate.php*. Находим в нем функцию @private function getSkinData()@. В самом начале функции присеваются переменные. Нас тут интересует переменная $out, после её инициализации нужно добавить код:

```php{11,12,13,14}
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
```

Что мы сделали? Мы добавили новую строчку в раздел head сайта. В принципе, тут так и пишем *addHeadItem* - добавить новый элемент head. Первый аргумент, у меня это ya_rtb - это просто идентификатор элемента, это нужно, чтобы при определенных условиях данный item заменить или удалить. Но нас это не интересует, потому что код будет вызываться на всех страницах сайта. Так что придумываем стопроцентно уникальную строчку, например, абракадабру.

Вторым аргументом вписываем саму строчку. Тут просто - код берем из РСЯ. Сейчас он у всех общих, так что можно просто скопировать. С первым файлом закончили.

Приступаем ко второму файлу *SkinVector.php*. Тут немного сложнее. В файле нужно найти функцию @public function getTemplateData()@, работать будем в данном методе.

Сразу в самом начале создаем переменную c кодом вызова, например, @yandeRTBHTML = 'КОД ВЫЗОВА РЕКЛАМЫ'; @. А теперь немного модифицируем то, что выдает функция: @ 'html-body-content' => $yandeRTBHTML . $this->wrapHTML( $title, $out->mBodytext ); @. В итоге получается:

```php{20,21,22,23,24,39}
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
```

В принципе и всё. Реклама будет показываться под заголовком статьи.
