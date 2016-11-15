/**
 * Created by huy on 23/10/16.
 */
require('./bootstrap');

// require('vue-router');
var VueRouter = require('vue-router');
Vue.use(VueRouter);
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/roleManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/roleManagement/add.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');