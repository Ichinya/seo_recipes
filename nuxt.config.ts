import { defineNuxtConfig } from 'nuxt'

// https://v3.nuxtjs.org/api/configuration/nuxt.config
export default defineNuxtConfig({
    image: {
        dir: 'assets/images',
        // Generate images to `/_nuxt/image/file.png`
        staticFilename: '[publicPath]/images/[name]-[hash][ext]',
    },
    modules: ['@nuxt/content', '@nuxtjs/tailwindcss', '@nuxt/image-edge',],
    content: {
        navigation: {
            fields: ['icon']
        },
        // https://content.nuxtjs.org/api/configuration
        highlight: {
            theme: 'github-dark',
            preload: ['php', 'ts', 'js']
        },
        markdown: {
            toc: {
                depth: 5,
                searchDepth: 5
            },
        }
    },
    tailwindcss: {
        cssPath: '~/assets/css/main.css',
    },
})
