import { defineClientConfig } from '@vuepress/client'

export default defineClientConfig({
    enhance({ app, router, siteData }) {
        router.beforeEach((to, from, next) => {
            if (to.name == '404') {
                next('404');
            } else {
                next();
            }
        });
    },
    setup() {

    },
    rootComponents: [],
})
