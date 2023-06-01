---
title: Sape.RTB в Laravel
description: Используем код SAPE в Laravel
icon: fa-solid fa-s
category: Laravel
tag: [Laravel, Sape, Sape RTB]
---

# Sape.RTB в Laravel

Ларавел довольно популярный framework. По идее, тому, кто сделал сайт на Laravel, не составит проблем подключить Sape. Ну или любой другой дополнительный функционал.

Но бывают разные ситуации. Например, программист был только на этапе запуска. А нанимать программиста, который это сделает, не всегда целесообразно.

А теперь сама установка. Способов очень много. Но мне показался более правильным такой: создаем новый провайдер (только для Sape), в нем указываем для каких шаблонов создавать новые переменные. А в шаблоне уже использовать стандартный код вывода.

А теперь подброднее:

## Создание нового провайдера

Создаем с помощью команды:

```bash
php artisan make:provider SapeServiceProvider
```

В результате чего у нас появится новый файл в папке `App\Providers`

Cам файл можно просто создать. Содержимое файла `SapeServiceProvider.php`:

```php[App/Providers/SapeServiceProvider.php]
namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SapeServiceProvider extends ServiceProvider
    {

    /**
    * Register services.
    * @return void
    */
    public function register()
        {
        //
        }
        
    /**
    * Bootstrap services.
    * @return void
    */
    public function boot()
        {
        //
        }
}
```

Далее его надо подключить. Для это открываем файл `config/app.php`. Находим там раздел *'providers'* и перед закрывающийся квадратной скобкой дописываем имя нашего класса

```php[config/app.php]
\App\Providers\SidebarServiceProvider::class,
```

По идее осталось совсем немноно.

## Создаем и передаем переменные клиента Sape

Для начала нужно скачать клиент и скопировать в проект. Например, в папку `/public`. То есть будет путь будет: `/path/to/laravel/public/длинный_ид_клиента_sape/sape.php`

Теперь в нашем провайдере добавляем следующее содержимое в функцию boot(), должно получится так:

```php{3}[sape.php]
public function boot()
    {
    View::composer('*', function ($view) {
        if (!defined('_SAPE_USER')) define('_SAPE_USER', 'кодСапы');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/' . _SAPE_USER . '/sape.php');
        $options = array();
        $options['force_show_code'] = true;
        $sape = new \SAPE_client($options);
        $view->with(compact('sape'));
        });
    }
```
Вместо звёздочки (первый параметр в View::composer) можно указать название файла, где будет доступен клиент. Примеры:

```php
View::composer(‘sidebar’, fn()=>{});
```
```php
View::composer([‘sidebar’,’main_menu’], fn()=>{});
```

Звёздочка обозначает, что созданные переменные будут доступны из любого места.

У меня это выглядит так:

```php{3} [sape.php]
View::composer('*', function ($view) {
    if (!defined('_SAPE_USER')) define('_SAPE_USER', 'кодСапы');
    require_once(resource_path('sape/sape.php'));
    $options = [
        'force_show_code' => true,
        'charset' => 'UTF-8',
        //'verbose' => true,
        ];
    $sapeArticles = new \SAPE_articles($options);
    $sape = new \SAPE_client($options);
    $sapeContext = new \SAPE_context();
    $sapeRtb = new \SAPE_rtb(['site_id' => 12345]);
    $sapeRtb->process_request();
    $view->with(compact('sape', 'sapeArticles', 'sapeRtb','sapeContext'));
});
```
Я код разместил в папке `/path/to/laravel/resources/sape/sape.php`. Это позволяет использовать разные клиенты не меня структуру файлов. Константу можно задавать в файле env. Но я этого не стал делать.

Что тут происходит: создается константа с идентификатором от Sape. Задаются начальные опции клиента (принудительные вывод кода и кодировка). А потом создаются различные клиенты, которые можно использовать в любом месте шаблона. Правильней будет передача нужных переменных в нужные шаблоны.

## Вывод ссылок

Теперь нужно в нужном месте шаблона вывести ссылки. Например:

```php
<p class="menu-label">Реклама</p>
<ul class="menu-list">
{!! $sape->return_links() !!}
</ul>
```
А текст для контекстной рекламы делается через функцию (нужно создать в провайдере переменную только):

```php
{!! $sapeContext->replace_in_text_segment($post->content) !!}
```
Это вместо

```php
{!! $post->content !!}.
```

## Итоги

Подключается и используется код очень легко. Всего пара минут. И чего я пять лет назад забросил Laravel, очень удобный framework.
