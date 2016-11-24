const elixir = require('laravel-elixir');
require('laravel-elixir-vue-2');

var dir = 'resources/assets/bower_components/';
gulp.task('copy', function () {

    //jquery
    gulp.src(dir + "jquery/dist/jquery.js")
        .pipe(gulp.dest("resources/assets/js/other/"));

    //bootstrap
    gulp.src(dir + "bootstrap/less/**").pipe(gulp.dest('resources/assets/less/bootstrap'));
    gulp.src(dir + "bootstrap/dist/js/bootstrap.js").pipe(gulp.dest('resources/assets/js/other/'));
    gulp.src(dir + "/bootstrap/dist/fonts/**").pipe(gulp.dest("resources/assets/fonts"));

    //font-awesome
    gulp.src(dir + "font-awesome/less/**").pipe(gulp.dest('resources/assets/less/font-awesome'));
    gulp.src(dir + "font-awesome/fonts/**").pipe(gulp.dest('resources/assets/fonts'));

    //datatables
    gulp.src(dir + "datatables.net/js/jquery.dataTables.js").pipe(gulp.dest('resources/assets/js/other/'));
    gulp.src(dir + "datatables.net-bs/js/dataTables.bootstrap.js").pipe(gulp.dest('resources/assets/js/other/'));

    //noty
    // gulp.src(dir + "noty/js/noty/packaged/jquery.noty.packaged.js").pipe(gulp.dest('resources/assets/js/other/'));

    //chosen
    // gulp.src(dir + "chosen/chosen.jquery.js").pipe(gulp.dest('resources/assets/js/other/'));
    // gulp.src(dir + "chosen/chosen.css").pipe(gulp.dest('resources/assets/css/'));

    //summer note
    gulp.src(dir + "summernote/dist/summernote.js").pipe(gulp.dest('resources/assets/js/other/'));
    gulp.src(dir + "summernote/dist/summernote.css").pipe(gulp.dest('resources/assets/css/'));

});
elixir(function (mix) {

    //for css
    // mix.less('admin.less', 'resources/assets/css/admin.css');
    // //
    // mix.styles([
    //     'admin.css',
    //     'other/animate.min.css',
    //     'plugin/AdminLTE.min.css',
    //     'plugin/select2/select2.min.css',
    //     'plugin/skins/_all-skins.css',
    // ], 'public/css/admin.css');


    //old
    // mix.styles([
    //     'admin.css',
    //     'other/pace-theme-flash.css',
    //     'other/summernote.css',
    //     'other/animate.min.css',
    //     // 'other/light-bootstrap-dashboard.css',
    // ], 'public/css/admin.css');
    // mix.scripts([
    //     'other/jquery.js',
    //     'other/bootstrap.js',
    //     'other/bootstrap-notify.js',
    //     'other/pace.js',
    //     'other/summernote.js',
    //     'other/jquery.dataTables.js'
    // ], 'public/js/admin.js');

    //for js
    // mix.scripts([
    //     'other/jquery.js',
    //     'other/bootstrap.js',
    //     'other/bootstrap-notify.js',
    //     'other/pace.js',
    //     'plugin/select2/select2.full.js',
    //     'plugin/app.js',
    // ], 'public/js/admin.js');


    // //sale
    // mix.webpack('quote-management.js', 'public/js/quote-management.js');
    // mix.webpack('order-management.js', 'public/js/order-management.js');
    mix.webpack('customer-management.js', 'public/js/customer-management.js');
    //
    // //warehouse
    // mix.webpack('warehouse-management.js', 'public/js/warehouse-management.js');
    // mix.webpack('pnk-management.js', 'public/js/pnk-management.js');
    // mix.webpack('pxk-management.js', 'public/js/pxk-management.js');
    //
    // //product
    // mix.webpack('product-management.js', 'public/js/product-management.js');
    // mix.webpack('type-management.js', 'public/js/type-management.js');
    mix.webpack('supplier-management.js', 'public/js/supplier-management.js');
    // mix.webpack('manufacturer-management.js', 'public/js/manufacturer-management.js');


    // mix.webpack('profile-management.js', 'public/js/profile-management.js');


});