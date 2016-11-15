/**
 * Created by huy on 23/10/16.
 */
require('./bootstrap');

// require('vue-router');
var VueRouter = require('vue-router');
Vue.use(VueRouter);
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/userManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/userManagement/add.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');