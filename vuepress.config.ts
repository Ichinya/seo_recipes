import {defineUserConfig} from 'vuepress'
import {hopeTheme} from "vuepress-theme-hope";
import {sitemapPlugin} from '@vuepress/plugin-sitemap'
import {seoPlugin} from '@vuepress/plugin-seo'
import {searchProPlugin, SearchProPluginOptions} from "vuepress-plugin-search-pro";
import viteBundler from "@vuepress/bundler-vite";
import {googleAnalyticsPlugin} from '@vuepress/plugin-google-analytics';
import {pwaPlugin} from '@vuepress/plugin-pwa';
import {commentPlugin} from '@vuepress/plugin-comment';
import {GiscusPluginOptions} from "@vuepress/plugin-comment/lib/node/options";

const searchPluginOption = <SearchProPluginOptions>{
    indexContent: true,
    customFields: [
        {
            getter: (page) => page.frontmatter.category,
            formatter: "Категория: $content",
        },
        {
            getter: (page) => page.frontmatter.tag,
            formatter: "Тег: $content",
        },
    ],
}

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
        logo: 'https://vuejs.press/images/hero.png',
        docsRepo: 'https://github.com/Ichinya/seo_recipes',
        docsBranch: 'main',
        docsDir: 'docs',
        lastUpdated: true,
        contributors: true,
        navbar: [
            '/info/',
            '/cookbook/',
            {text: 'Список тегов', link: '/tag/', icon: 'fa-solid fa-tags'},
            {text: 'Список категорий', link: '/category/', icon: 'fa-solid fa-folder-tree'},
            {text: 'Таймлайн', link: '/timeline/', icon: 'fa-solid fa-timeline'},
            {text: 'Блог', link: 'https://ichiblog.ru'}
        ],
        sidebar: {
            '/cookbook/': "structure",
            '/info/': "structure",
            '/': [""],
        },
        sidebarSorter: ["readme", "order", "title"],
        iconAssets: ["fontawesome", "fontawesome-with-brands"],
        iconPrefix: "",
        backToTop: true,
        footer: `<!-- Yandex.Metrika counter --><noscript><div><img src="https://mc.yandex.ru/watch/90252793" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->`,
        copyright: '',
        displayFooter: true,
        pageInfo: [
            "Author", "PageView", "Date", "Category", "Tag", "ReadingTime", "Word"
        ],
        author: {name: 'Ичи', url: 'https://ichiblog.ru'},
        plugins: {
            blog: true,
            git: {
                createdTime: true,
                updatedTime: true,
                contributors: true,
            },
            components: {components: ["VidStack", "SiteInfo"]},
            prismjs: true,
            seo: seoPlugin({
                hostname: "https://seo-recipes.ru/"
            }),
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
        searchProPlugin(searchPluginOption),
        sitemapPlugin({hostname: 'https://seo-recipes.ru/'}),
        googleAnalyticsPlugin({
            id: 'G-YFXPYL3Y6H',
        }),
        pwaPlugin({favicon: '/favicon.ico', manifest: {lang: 'ru-RU'}}),
        commentPlugin(<GiscusPluginOptions>{
            provider: 'Giscus',
            repoId: 'R_kgDOGHxn6A',
            category: 'Комментарии',
            categoryId: 'DIC_kwDOGHxn6M4CiifV',
            repo: 'Ichinya/seo_recipes',
            mapping: 'title',
            strict: '0',
            reactionsEnabled: '1',
            inputPosition: 'top',
        }),
        {src: '~/vercel.ts', mode: 'client'}
    ],
    bundler: viteBundler(),
})
