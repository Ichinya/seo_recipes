import { defineUserConfig } from 'vuepress'
import { prismjsPlugin } from '@vuepress/plugin-prismjs'
import { hopeTheme } from "vuepress-theme-hope";
import { searchPlugin } from "@vuepress/plugin-search";
import { SitemapOptions } from "vuepress-plugin-sitemap2";

export default defineUserConfig({
    lang: 'ru-RU',
    title: 'SEO Рецепты',
    description: 'Различные рецепты, советы, инструкции по сео и настройки сайтов',
    shouldPrefetch: false,
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
            
            ym(90252793, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true, webvisor: true
            });
            <!-- /Yandex.Metrika counter -->
        `],
    ],
    theme: hopeTheme({
        docsRepo: 'https://github.com/Ichinya/seo_recipes',
        docsBranch: 'main',
        docsDir: 'content', // fix изменить на docs
        lastUpdated: true,
        contributors: true,
        navbar: [
            '/info/',
            '/cookbook/',
            { text: 'Список тегов', link: '/tag/', icon: 'solid fa-tags' },
            { text: 'Список категорий', link: '/category/', icon: 'solid fa-folder-tree' },
            { text: 'Блог', link: 'https://ichiblog.ru' }
        ],
        sidebar: {
            '/cookbook/': "structure",
            '/info/': "structure",
            '/': [""],
        },
        iconAssets: "fontawesome",
        backToTop: true,
        footer: '<!-- Yandex.Metrika counter --><noscript><div><img src="https://mc.yandex.ru/watch/90252793" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->',
        copyright: '',
        displayFooter: true,
        pageInfo: [
            "Author", "PageView", "Date", "Category", "Tag", "ReadingTime", "Word"
        ],
        author: { name: 'Ичи', url: 'https://ichiblog.ru' },
        plugins: {
            blog: true,
            git: {
                createdTime: true,
                updatedTime: true,
                contributors: true,
            },
            sitemap: <SitemapOptions>{ hostname: 'https://seo-recipes.ru/', canonicalTag: true },
            pwa: { favicon: '/favicon.ico', manifest: { lang: 'ru-RU' } },
        }
    }),
    locales: {
        "/": {
            lang: "ru-RU",
            title: "SEO Рецепты",
            description: "Различные рецепты, советы, инструкции по сео и настройки сайтов.",
        }
    },
    public: `./public`,
    plugins: [
        prismjsPlugin({
            preloadLanguages: ['php', 'js', 'ts']
        }),
        searchPlugin(),
    ],
})
