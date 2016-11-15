<template>
    <form class="panel panel-default" @submit.prevent="addNew">
        <div class="panel-heading">
            <h3>Phiếu Nhập Kho </h3>
        </div>
        <div class="panel-body">
            <div class="form form-horizontal">
                <div class="form-group" :class="{'has-error': form.$errors.has('tax')}">
                    <label class="col-sm-2 control-label">Thuế (%)</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.01" v-model="form.$fields.tax" class="form-control">
                        <label v-if="form.$errors.has('tax')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.tax[0]}}</label>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.$errors.has('shipping')}">
                    <label class="col-sm-2 control-label">Phí giao hàng</label>
                    <div class="col-sm-8">
                        <input type="number" v-model="form.$fields.shipping" class="form-control">
                        <label v-if="form.$errors.has('shipping')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.shipping[0]}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" v-model="form.$fields.description"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="panel-body">
            <div>
                <button type="button" class="btn btn-app btn-info" @click="addRow"><i class="fa fa-plus-circle" aria-hidden="true"></i><span v-if="form.$errors.has('rows')" class="badge bg-red">{{form.$errors.$errors.rows[0]}}</span></button>
            </div>
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
                                <!--<selectMe :products="products" v-model="item.selected"></selectMe>-->
                                <select v-model="item.product_id" class="form-control" style="width : 100%;">
                                    <option v-for="option in products" v-bind:value="option.id">{{option.name}}</option>
                                </select>
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
        <div class="panel-footer">

            <button :disabled="form.$busy" type="submit" class="btn btn-primary btn-lg" @click="addNew"><i class="fa fa-save"></i> Lưu</button>
            <router-link :to="{ name: 'list' }" class="btn btn-default btn-lg"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
        </div>
    </form>
</template>

<script>
    export default{
        data : function () {
            return {
                products : [],
                list_status : [],
                form: this.$form({
                    'status_id': 2,
                    'description': null,
                    'shipping': 0,
                    'tax': 0,
                    'rows' : [],
                })
            };
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
                    console.log(response.body);
                    me.notify('<i class="fa fa-check" aria-hidden="true"></i> Thành công', 'success', '<br><a href="nk-management#/view/' + response.body + '">Xem chi tiết</a>');
                }, function (response) {
                    me.$Progress.fail();
                });
            },
            addRow : function () {
                this.form.$fields.rows.push({
                    product_id : -1,
                    qty : 1,
                    price : '',
                });
            },
            fetchData : function () {
                this.$Progress.start();
                this.$http.get('api/product').then(function (response) {
                    this.products = response.body;
                    this.$Progress.finish();
                })
                this.$http.get('api/status_nk').then(function (response) {
                    this.list_status = response.body;
                    this.$Progress.finish();
                })
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
