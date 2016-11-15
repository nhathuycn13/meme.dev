
window._ = require('lodash');

window.Vue = require('vue');
require('jquery');
require('vue-resource');

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);
    next();
});

import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

import VueTimeago from 'vue-timeago'

Vue.use(VueTimeago, {
    name: 'timeago',
    locale: 'vi-VI',
    locales: {
        'vi-VI': [
            "just now",
            ["%s giây trước", "%s giây trước"],
            ["%s phút trước", "%s phút trước"],
            ["%s gìơ trước", "%s gìơ trước"],
            ["%s ngày trước", "%s ngày trước"],
            ["%s tuần trước", "%s tuần trước"],
            ["%s tháng trước", "%s tháng trước"],
            ["%s năm trước", "%s năm trước"]
        ]

    }
})

import LaravelValidator from 'vue-laravel-validator';
Vue.use(LaravelValidator);


