import VueRouter from 'vue-router'

import routes from './routes'

export default () => {
    const router = new VueRouter({
        routes
    })

    router.beforeEach((to, from, next) => {
        if (to.meta.requiresAuth) {
            if (Store.state.AuthUser.authenticated || jwtToken.getToken()) {
                return next()
            } else {
                return next({'name': 'login'})
            }
        }
        if (to.meta.requiresGuest) {
            if (Store.state.AuthUser.authenticated || jwtToken.getToken()) {
                return next({'name': 'home'})
            } else {
                return next()
            }
        }
        next()
    })

    return router
}