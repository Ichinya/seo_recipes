# SEO Рецепты

Различные рецепты, советы, инструкции по сео и настройки сайтов.

## Стек технологий:

* VuePress 2 + vuepress-theme-hope
* Vue 3 + TypeScript

## Сайт

Сайт расположена на сайте [seo-recipes.ru](https://seo-recipes.ru)

Статьи находятся в папке `docs`

Для отображения картинки в статье используется код `![Картинка](./1.png)`, картинка будет браться из папки со статьёй

## Редактирование

Правки может предлагать любой пользователь github.com

Пример описания

```yaml
title: Название страницы
description: Краткое описание страницы
icon: solid fa-font-awesome # иконка, берется с сайта https://fontawesome.com/ и убирается первая часть fa. В примере fa-solid fa-font-awesome
author:
  - name: Имя
    url: Ссылка на сайт или соцсеть
category: yandex
tag: [ yandex, ads ]
```

Пример страцицы

```md
---
Описание страницы
---

# Сама страница

Используется разметка markdown

```

Про разметку можно посмотреть на
сайте [vuepress](https://vuepress-theme-hope.gitee.io/v2/ru/cookbook/markdown/demo.html)


![Alt](https://repobeats.axiom.co/api/embed/24c6dac53289f0b53e67428753bc75c661cacae3.svg "Repobeats analytics image")