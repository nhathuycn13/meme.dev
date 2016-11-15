/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');

// require('vue-router');
var VueRouter = require('vue-router');
Vue.use(VueRouter);
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/supplierManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/supplierManagement/add.vue')},
        {path : '/update/:id', name : 'update', component : require('./components/supplierManagement/update.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');