/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');

var VueRouter = require('vue-router');
Vue.use(VueRouter);

//active class sidebar
document.getElementById('sale').className += " active";
document.getElementById('customer').className += " active";
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/customerManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/customerManagement/add.vue')},
        {path : '/update/:id', name : 'update', component : require('./components/customerManagement/update.vue')},
        {path : '/view/:id', name : 'view', component : require('./components/customerManagement/view.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');