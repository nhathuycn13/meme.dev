/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');
var VueRouter = require('vue-router');
Vue.use(VueRouter);
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/pnkManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/pnkManagement/add.vue')},
        {path : '/update/:id', name : 'update', component : require('./components/pnkManagement/update.vue')},
        {path : '/view/:id', name : 'view', component : require('./components/pnkManagement/view.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');