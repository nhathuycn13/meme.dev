<template>
    <form class="panel panel-default" @submit.prevent="addNew">
        <div class="panel-heading">
            <h3>Phiếu Báo Gía </h3>
        </div>
        <div class="panel-body">
            <div class="form form-horizontal">
                <div class="form-group" :class="{'has-error': form.$errors.has('status_id')}">
                    <label class="col-sm-2 control-label">Khách hàng *</label>
                    <div class="col-sm-8">
                        <select v-model="form.$fields.customer_id" class="form-control">
                            <option v-for="s in customers" v-bind:value="s.id">{{ s.name }}</option>
                        </select>
                        <label v-if="form.$errors.has('status_id')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.status_id[0]}}</label>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.$errors.has('payment_type_id')}">
                    <label class="col-sm-2 control-label">Thanh toán</label>
                    <div class="col-sm-8">
                        <select v-model="form.$fields.payment_type_id" class="form-control">
                            <option v-for="s in payments" v-bind:value="s.id">{{ s.name }}</option>
                        </select>
                        <label v-if="form.$errors.has('payment_type_id')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.payment_type_id[0]}}</label>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.$errors.has('expirated_at')}">
                    <label class="col-sm-2 control-label">Ngaỳ hết hạn</label>
                    <div class="col-sm-8">
                        <input type="date" v-model="form.$fields.expirated_at" class="form-control">
                        <label v-if="form.$errors.has('expirated_at')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.expirated_at[0]}}</label>
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

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Chi tiết</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Khác </a></li>
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
                                    <th>Đơn Giá</th>
                                    <th>Giảm Giá</th>
                                    <th>Thuế</th>
                                    <th>Thành Tiền</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr v-for="(item, index) in form.$fields.rows">
                                    <td>
                                        {{index + 1}}
                                    </td>
                                    <td>
                                        <select v-model="item.product_id" class="form-control" style="width : 100%;">
                                            <option v-for="option in products.data" v-bind:value="option.id">{{option.name}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" v-model="item.qty" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" v-model="item.price" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" step="0.1" v-model="item.discount" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" step="0.1" v-model="item.tax" class="form-control">
                                    </td>
                                    <td>{{ subtotalItem(item) }}</td>
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
                                    <th>Đơn Giá</th>
                                    <th>Giảm Giá</th>
                                    <th>Thuế</th>
                                    <th>Thành Tiền</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">

                            </div>
                            <!-- /.col -->
                            <div class="col-xs-6">
                                <p class="lead"></p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Tổng cộng (đã tính thuế):</th>
                                            <td> {{ total }}VND</td>
                                        </tr>
                                        <tr>
                                            <th>Phí vận chuyển:</th>
                                            <td>{{ form.$fields.shipping }} VND</td>
                                        </tr>
                                        <tr>
                                            <th>Tất cả:</th>
                                            <td> {{ total + form.$fields.shipping }} VND</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        The European languages are members of the same family. Their separate existence is a myth.
                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                        new common language would be desirable: one could refuse to pay expensive translators. To
                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                        words. If several languages coalesce, the grammar of the resulting language is more simple
                        and regular than that of the individual languages.
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
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
                customers : [],
                payments : [],
                form: this.$form({
                    'customer_id': null,
                    'description': null,
                    'payment_type_id' : null,
                    'shipping': 0,
                    'expirated_at' : '',
                    'rows' : [],
                })
            };
        },
        created : function () {
            this.fetchData();
        },
        computed : {
            'total' : function () {
                var fuck = 0;
                $.each(this.form.$fields.rows, function () {
                    var result =this.qty * this.price;
                    var discount = result/100 * this.discount;
                    result -= discount;
                    var tax = result/100 * this.tax;
                    //return result + tax;
                    fuck += result + tax;
                });
                return fuck;
            }
        },
        methods : {
            addNew : function () {
                this.$Progress.start();
                var me = this;
                this.form.post('api/quote').then(function (response) {
                    me.$Progress.finish();
                    console.log(response.body);
                    me.notify('<i class="fa fa-check" aria-hidden="true"></i> Thành công', 'success', '<br><a href="quote-management#/view/' + response.body + '">Xem chi tiết</a>');
                }, function (response) {
                    me.$Progress.fail();
                });
            },
            addRow : function () {
                this.form.$fields.rows.push({
                    product_id : -1,
                    qty : 1,
                    discount : 0,
                    price : '',
                    tax : 0,
                });
            },
            subtotalItem : function (item) {
                var result =item.qty * item.price;
                var discount = result/100 * item.discount;
                result -= discount;
                var tax = result/100 * item.tax;
                return result + tax;
            },
            fetchData : function () {
                this.$Progress.start();
                this.$http.get('api/customer').then(function (response) {
                    this.customers = response.body;
                    this.$Progress.finish();
                })
                this.$http.get('api/product').then(function (response) {
                    this.products = response.body;
                    this.$Progress.finish();
                })
                this.$http.get('api/payment').then(function (response) {
                    this.payments = response.body;
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
