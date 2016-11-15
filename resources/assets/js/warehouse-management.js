/**
 * Created by huy on 26/10/16.
 */
require('./bootstrap');
// require('vue-router');
var VueRouter = require('vue-router');
Vue.use(VueRouter);
const router = new VueRouter({
    routes : [
        {path : '/', name : 'list', component: require('./components/warehouseManagement/list.vue')},
    ]
});

var vm = new Vue({
    router,
}).$mount('#app');