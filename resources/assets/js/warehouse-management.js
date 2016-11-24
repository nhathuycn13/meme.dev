/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');
var VueRouter = require('vue-router');
Vue.use(VueRouter);

//active class sidebar
document.getElementById('warehouse-management').className += " active";
document.getElementById('warehouse').className += " active";
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/warehouseManagement/list.vue')},
    ]
});

var vm = new Vue({
    router,
}).$mount('#app');