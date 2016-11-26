<template>
    <!--todoHuy: sua template-->
    <div class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Thêm Mới Báo Giá
                    <div class="pull-right">
                        <i class="fa fa-globe"></i> In1, Inc.
                    </div>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Chi tiết</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Ghi chú </a></li>
                        <li class="pull-right">
                            <button type="button" class="btn btn-app btn-info" @click="addRow"><i class="fa fa-plus-circle" aria-hidden="true"></i><span v-if="form.$errors.has('rows')" class="badge bg-red">{{form.$errors.$errors.rows[0]}}</span></button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form form-horizontal">
                                <table class="table table-hover" id="meme">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sản Phẩm</th>
                                        <th>Số Lượng</th>
                                        <th>Giá Nhập</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(item, index) in form.$fields.rows">
                                        <td>
                                            {{index + 1}}
                                        </td>
                                        <td>
                                            <multiselect :options="products"
                                                         v-model="item.product_id"
                                                         :value="item.product_id"
                                                         :local-search="false"
                                                         :clear-on-select="true"
                                                         :close-on-select="true"
                                                         :loading="isLoading"
                                                         @search-change="asyncFind"
                                                         track-by="id"
                                                         label="name"
                                                         placeholder="Nhập loại sản phẩm"
                                                         selectLabel="Nhấn enter để chọn"
                                                         deselectLabel = "Nhấn enter bor chọn"></multiselect>
                                        </td>
                                        <td>
                                            <input type="text" v-model="item.qty" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" v-model="item.price" class="form-control">
                                        </td>
                                        <td>
                                            <a @click="form.$fields.rows.splice(index, 1)" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Sản Phẩm</th>
                                        <th>Số Lượng</th>
                                        <th>Giá Nhập</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <form @submit.prevent="addNew" class="form form-horizontal">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Ghi chú</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" v-model="form.$fields.description"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <div class="form-group">
                    <div class="col-sm-8">
                        <button :disabled="form.$busy" type="submit" class="btn btn-primary" @click="addNew"><i class="fa fa-save"></i> Lưu</button>
                        <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect'
    export default{
        data : function () {
            return {
                isLoading : false,
                products : [],
                form: this.$form({
                    'NK_status_id': 1,
                    'description': null,
                    'rows' : [],
                })
            };
        },
        components: {
            Multiselect,
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            addNew : function () {
                this.$Progress.start();
                var me = this;
                this.form.post('api/nk').then(function (response) {
                    me.$Progress.finish();
                    me.notify('<i class="fa fa-check" aria-hidden="true"></i> Thành công', 'success', '<br><a href="nk-management#/view/' + response.body + '">Xem chi tiết</a>');
                    me.form.$fields = {
                        'NK_status_id': 1,
                        'description': null,
                        'rows' : [],
                    }
                }, function (response) {
                    me.$Progress.fail();
                });
            },
            addRow : function () {
                this.form.$fields.rows.push({
                    product_id : null,
                    qty : 1,
                    price : 0,
                });
            },
            fetchData : function () {
                this.$Progress.start();
                this.$Progress.finish();
            },
            asyncFind : function (query) {
                if (query.length === 0) {
                    this.options = []
                } else {
                    this.isLoading = true
                    this.$http.get('api/product/search/' + query).then(function (response) {
                        if (response.body === [])
                        {
                            console.log('empty')
                        }else{
                            this.products = response.body;
                        }
                        this.isLoading = false;
                    }, function (response) {
                        this.isLoading = false;
                    });
                }
            },
            notify : function(title, type, text) {
                $.notify({
                    title : '<h4>' + title + '</h4>',
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
