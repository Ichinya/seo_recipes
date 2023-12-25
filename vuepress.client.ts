import {defineClientConfig} from '@vuepress/client'
import {inject} from '@vercel/analytics';
import {injectSpeedInsights} from '@vercel/speed-insights';

export default defineClientConfig({
    enhance({router}) {
        inject();
        injectSpeedInsights({
            framework: 'vuepress', route: router.currentRoute.value.path
        })
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
