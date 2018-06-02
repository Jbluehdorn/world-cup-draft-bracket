import VueRouter from 'vue-router';

export default new VueRouter({
    linkActiveClass: 'active',
    routes: [{
        path: '/',
        component: require('./components/Index'),
        children: [{
            path: '/',
            component: require('./components/Home')
        }, {
            path: '/profile',
            redirect: '/profile/' + window.user.sub.substring(6, window.user.sub.length)
        }, {
            path: '/profile/:sub',
            component: require('./components/Profile')
        }]
    }]
})