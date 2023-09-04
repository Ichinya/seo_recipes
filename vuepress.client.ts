import { defineClientConfig } from '@vuepress/client'

export default defineClientConfig({
    enhance({router}) {
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
