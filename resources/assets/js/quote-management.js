/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');

var VueRouter = require('vue-router');
Vue.use(VueRouter);

//active class sidebar
document.getElementById('sale').className += " active";
document.getElementById('quote').className += " active";
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/quoteManagement/list.vue')},
        {path : '/add', name : 'add', component : require('./components/quoteManagement/add.vue')},
        {path : '/update/:id', name : 'update', component : require('./components/quoteManagement/update.vue')},
        {path : '/view/:id', name : 'view', component : require('./components/quoteManagement/view.vue')},
        {path : '/send-mail/:id', name : 'sendMail', component : require('./components/quoteManagement/email.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');