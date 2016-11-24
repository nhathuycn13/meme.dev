/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');
var VueRouter = require('vue-router');
Vue.use(VueRouter);

//active class sidebar
document.getElementById('sale').className += " active";
document.getElementById('order').className += " active";

const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/orderManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/orderManagement/add.vue')},
        {path : '/update/:id', name : 'update', component : require('./components/orderManagement/update.vue')},
        {path : '/view/:id', name : 'view', component : require('./components/orderManagement/view.vue')},
        {path : '/send-mail/:id', name : 'sendMail', component : require('./components/orderManagement/email.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');