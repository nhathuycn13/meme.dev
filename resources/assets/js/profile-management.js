/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');
var VueRouter = require('vue-router');
Vue.use(VueRouter);

//active class sidebar
// document.getElementById('sale').className += " active";
// document.getElementById('order').className += " active";

const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/profileManagement/view.vue')},
        {path : '/update/:id', name : 'update', component : require('./components/profileManagement/update.vue')},
    ]
});

var vm = new Vue({
    router,

}).$mount('#app');