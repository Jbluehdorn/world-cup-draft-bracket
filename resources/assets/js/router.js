import VueRouter from 'vue-router';

export default new VueRouter({
    linkActiveClass: '',
    linkExactActiveClass: 'active',
    routes: [{
        path: '/',
        component: require('./components/Home')
    }, {
        path: '/profile',
        redirect: '/profile/' + window.user.sub.substring(6, window.user.sub.length)
    }, {
        path: '/profile/:sub',
        component: require('./components/Profile')
    }, {
        path: '/teams',
        component: require('./components/Teams/Index'),
        beforeEnter: (to, from, next) => {
            if(!window.user.role.includes('admin')) {
                next('/error');
            }

            next();
        },
        children: [{
            path: 'new',
            component: require('./components/Teams/Create')
        }]
    }, {
        path: '/error',
        component: require('./components/AccessDenied')
    }]
})