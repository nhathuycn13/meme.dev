/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');

var VueRouter = require('vue-router');
Vue.use(VueRouter);

//active class sidebar
document.getElementById('product-management').className += " active";
document.getElementById('product').className += " active";
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/productManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/productManagement/add.vue')},
        {path : '/update/:id', name : 'update', component : require('./components/productManagement/update.vue')},
        {path : '/view/:id', name : 'view', component : require('./components/productManagement/view.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');