---
title: Установка Яндекс.Метрики на VuePress
description: Установка Яндекс.Метрики на VuePress
icon: fa-brands fa-yandex
category: VuePress
tag: [VuePress, VueJS, Метрика]
---

# Установка Яндекс.Метрики на VuePress

Установить счетчик несложно и есть несколько разных способов. Один из них - использовать плагины. Но у меня возникли сложности с устновкой одного из плагина. И в нем не было одной нужной мне настройки. Но данных способ подойдет 95% разработчикам.

Я же заморочился и нашел, как вставить код в тему, не меняя самой темы.

Для начала разберем сам код метрики (данный код взят из кабинета летом 2022). У Вас код может выглядеть по другому, как минимум я убрал номер счетчика (в примере вместо него написано `КОД`)

```html{9,16}
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(КОД, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/КОД" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
```

Данный код можно разделить на две части. Первая всё что между тегами `script` (это строки 3-14 в примере выше) и часть с `noscript` в строке 16.

А теперь вставляем нужные части в код конфига, у меня это `vuepress.config.ts`

Первую часть вставляем в раздел `head`. Можно создать отдельный файл и указать путь к нему. Но я решил вставить прямо сюда, так как возникает меньше проблем с блокировщиком и политикой CORS. А вторую часть я вставил в `footer` темы.

Обратите внимание, что при этом надо включить футер. Вторая часть срабатывает, если отключены скрипты. Своего рода рекламный пиксель. Яндекс по нему отслеживает ботов.

```ts{3-25}{28}
export default defineUserConfig({
    head: [
        ['script', {}, `
            <!-- /Yandex.Metrika counter -->
            (function (m, e, t, r, i, k, a) {
                m[i] = m[i] || function () {
                    (m[i].a = m[i].a || []).push(arguments)
                };
                m[i].l = 1 * new Date();
                for (var j = 0; j < document.scripts.length; j++) {
                    if (document.scripts[j].src === r) {
                        return;
                    }
                }
                k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
            })
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
            
            ym(Код, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true, webvisor: true
            });
            <!-- /Yandex.Metrika counter -->
        `],
    ],
    theme: {
        footer: '<!-- Yandex.Metrika counter --><noscript><div><img src="https://mc.yandex.ru/watch/КОД" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->',
        displayFooter: true,
    },
})
```

Вот и всё. Установка занимает буквально пару минут. Секунд 20 на следования инструкции, а остальное время на поиск этой статьи.

Таким нехитрым методом можно установить любой js код или счётчик. Если вставлять счетчики, то лучше эту часть конфига вынести в отдельный файл.
