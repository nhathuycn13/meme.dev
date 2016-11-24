<template>
    <div>
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Trạng thái</h3>

                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Tất cả
                                    <span class="label label-primary pull-right">12</span></a></li>
                                <li><a href="#"><input type="checkbox"> Đơn Hàng</a></li>
                                <li><a href="#"><input type="checkbox"> Chuẩn Bị Giao Hàng <span class="label label-warning pull-right">65</span></a></li>
                                <li><a href="#"><input type="checkbox"> Đã Hủy <span class="label label-warning pull-right">65</span></a></li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /. box -->
                    <div>
                        <router-link :to="{ name: 'add' }" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</router-link>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Danh Sách Đơn Hàng</h3>

                            <div class="box-tools pull-right">
                                <div class="has-feedback">
                                    <input type="text" class="form-control input-sm" placeholder="Search Order">
                                    <span class="fa fa-search form-control-feedback"></span>
                                </div>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Khách hàng</th>
                                        <th>Nhân viên</th>
                                        <th>Thời gian</th>
                                        <th></th>
                                    </tr>

                                    <tr v-for="type in items">
                                        <td><input type="checkbox"></td>
                                        <td><router-link :to="{ name:'view', params : { id : type.id} }">SO{{ getId(type.id) }}</router-link></td>
                                        <td>{{type.customer.name}}</td>
                                        <td>{{type.user.name}}</td>
                                        <td><timeago class="mailbox-date" :since="type.created_at" :auto-update="60"></timeago></td>
                                        <td class="pull-right">
                                            <div class="btn-group">
                                                <router-link :to="{ name: 'update', params: { id : type.id} }"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                                                <router-link :to="{ name: 'view', params: { id : type.id} }"><i class="fa fa-eye" aria-hidden="true"></i></router-link>
                                                <a type="button" @click.prevent="deleteItem(type.id)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer no-padding">
                            <div class="mailbox-controls">
                                <!-- Check all button -->
                                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                                <div class="pull-right">
                                    1-50/200
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                </div>
                                <!-- /.pull-right -->
                            </div>
                        </div>
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>

</template>
<script>
    export default{
        data : function () {
            return {
                items : []
            };
        },
        created: function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$Progress.start();
                this.$http.get('api/order').then(function (response) {
                    this.items = response.body;
                    this.$Progress.finish()
                }, function (response) {
                    this.$Progress.fail()
                });
            },
            deleteItem : function (id) {
                var confirm = window.confirm("Are you sure?");
                if (!confirm) return;
                this.$Progress.start();
                this.$http.delete('api/order/' + id).then(function (response) {
                    this.$Progress.finish();
                    if (response.body == '1'){
                        this.notify('Deleted', 'success', '');
                        this.fetchData();
                    }
                }, function (response) {
                    this.notify('Error', 'danger', '');
                    this.$Progress.fail();
                });
            },
            getId : function (n) {
                n = n + '';
                return n.length >= 5 ? n : new Array(5 - n.length + 1).join('0') + n;
            },
            notify : function(title, type, text) {
                $.notify({
                    title : '<i class="fa fa-times" aria-hidden="true"></i> <strong>' + title + '</strong>',
                    icon : '',
                    message: text,
                    animate: {
                        enter: 'animated bounce',
                        exit: 'animated fadeOutUp'
                    },
                    showProgressbar: true,
                },{
                    type : type,
                    animate: {
                        enter: 'animated bounceInDown',
                        exit: 'animated bounceOutUp'
                    },

                });
            }
        }
    }
</script>