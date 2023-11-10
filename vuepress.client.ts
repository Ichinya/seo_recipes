import {defineClientConfig} from '@vuepress/client'
import {inject} from '@vercel/analytics';

export default defineClientConfig({
    enhance({router}) {
        inject();
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
