<?php if (!defined('BASE_DIR')) exit('No direct script access allowed');
/**

title: Sape.RTB в Laravel
description: Используем код SAPE в Laravel
slug: laravel/sape_rtb
layout: seo.php
parser: simple geshi

menu[title]: Sape.RTB в Laravel
menu[group]: Laravel
menu[order]: 1

-articleClass: pad30

**/

?>

h1(mar0 bg-lime200 pad30-rl pad10-tb) Sape.RTB в Laravel

div(pad30-rl mar30-tb)

    _ Ларавел довольно популярный framework. По идее, тому, кто сделал сайт на Laravel, не составит проблем подключить Sape. Ну или любой другой дополнительный функционал.

    _ Но бывают разные ситуации. Например, программист был только на этапе запуска. А нанимать программиста, который это сделает, не всегда целесообразно.

    _ А теперь сама установка. Способов очень много. Но мне показался более правильным такой: создаем новый провайдер (только для Sape), в нем указываем для каких шаблонов создавать новые переменные. А в шаблоне уже использовать стандартный код вывода.

    _ А теперь подброднее:

    h2 Создание нового провайдера

    _ Создаем с помощью команды:

geshi_bash
php artisan make:provider SapeServiceProvider
/geshi

    _ В результате чего у нас появится новый файл в папке App\Providers

    _ Cам файл можно просто создать. Содержимое файла @SapeServiceProvider.php@:

<!-- nosimple -->
geshi_php
namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class SapeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
/geshi
<!-- /nosimple -->

    _ Далее его надо подключить. Для это открываем файл @config/app.php@. Находим там раздел *‘providers’* и перед закрывающийся квадратной скобкой дописываем имя нашего класса

geshi_php
    \App\Providers\SidebarServiceProvider::class,
/geshi

    _ По идее осталось совсем немноно.

    h2 Создаем и передаем переменные клиента Sape

    _ Для начала нужно скачать клиент и скопировать в проект. Например, в папку @/public@. То есть будет путь будет: @/path/to/laravel/public/длинный_ид_клиента_sape/sape.php@

    _ Теперь в нашем провайдере добавляем следующее содержимое в функцию boot(), должно получится так:

geshi_php(lines=3)
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
/geshi

    _ Вместо звёздочки (первый параметр в View::composer) можно указать название файла, где будет доступен клиент. Примеры:

    _ geshi_php View::composer(‘sidebar’, fn()=>{});/geshi
    _ geshi_php View::composer([‘sidebar’,’main_menu’], fn()=>{});/geshi

    _ Звёздочка обозначает, что созданные переменные будут доступны из любого места.

    _ У меня это выглядит так:

geshi_php(lines=2)
        View::composer('*', function ($view) {
            if (!defined('_SAPE_USER')) define('_SAPE_USER', 'кодСапы');
            require_once(resource_path('sape/sape.php'));
            $options = [
                'force_show_code' => true,
                'charset' => 'UTF-8',
//                'verbose' => true,
            ];
            $sapeArticles = new \SAPE_articles($options);
            $sape = new \SAPE_client($options);
            $sapeContext = new \SAPE_context();
            $sapeRtb = new \SAPE_rtb(['site_id' => 12345]);
            $sapeRtb->process_request();
            $view->with(compact('sape', 'sapeArticles', 'sapeRtb','sapeContext'));
        });
/geshi

    _ Я код разместил в папке @/path/to/laravel/resources/sape/sape.php@. Это позволяет использовать разные клиенты не меня структуру файлов. Константу можно задавать в файле env. Но я этого не стал делать.

    _ Что тут происходит: создается константа с идентификатором от Sape. Задаются начальные опции клиента (принудительные вывод кода и кодировка). А потом создаются различные клиенты, которые можно использовать в любом месте шаблона. Правильней будет передача нужных переменных в нужные шаблоны.

    h2 Вывод ссылок

    _ Теперь нужно в нужном месте шаблона вывести ссылки. Например:
geshi_php
        <p class="menu-label">Реклама</p>
        <ul class="menu-list">
            {!! $sape->return_links() !!}
        </ul>
/geshi

        _ А текст для контекстной рекламы делается через функцию (нужно создать в провайдере переменную только):

geshi_php
    {!! $sapeContext->replace_in_text_segment($post->content) !!}
/geshi

    _ Это вместо

geshi_php
    {!! $post->content !!}.
/geshi

    h2 Итоги

    _ Подключается и используется код очень легко. Всего пара минут. И чего я пять лет назад забросил Laravel, очень удобный framework.

    <?php snippet('next-prev', ['', '']); ?>

/div
