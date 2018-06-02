import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

Vue.use(VueResource)

Vue.use(VueRouter)
const router = require('./router').default

const vm = new Vue({
    router,
    render: h => h(require('./App.vue'))
}).$mount('#app')