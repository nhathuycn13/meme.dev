/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');
var VueRouter = require('vue-router');
Vue.use(VueRouter);
//active class sidebar
document.getElementById('product-management').className += " active";
document.getElementById('type').className += " active";
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/typeManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/typeManagement/add.vue')},
        {path : '/update/:id', name : 'update', component : require('./components/typeManagement/update.vue')},
        {path : '/view/:id', name : 'view', component : require('./components/typeManagement/view.vue')},

    ]
});

var vm = new Vue({
    router,

}).$mount('#app');