import { defineUserConfig } from 'vuepress'
import { prismjsPlugin } from '@vuepress/plugin-prismjs'
import { hopeTheme } from "vuepress-theme-hope";
import { searchPlugin } from "@vuepress/plugin-search";
import { SitemapOptions } from "vuepress-plugin-sitemap2";

export default defineUserConfig({
    shouldPrefetch: undefined,
    markdown: undefined,
    lang: 'ru-RU',
    title: 'SEO Рецепты',
    description: 'Про',
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
        footer: 'Footer',
        copyright: 'Cop',
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
