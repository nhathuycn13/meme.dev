<template>
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
                <form @submit.prevent="addNew" class="form form-horizontal">
                    <div class="form-group" :class="{'has-error': form.$errors.has('customer_id')}">
                        <label class="col-sm-2 control-label">Khách hàng *</label>
                        <div class="col-sm-8">
                            <!--todoHuy: viet-->
                            <multiselect :options="customers"
                                         :value="form.$fields.customer_id"
                                         :local-search="false"
                                         :clear-on-select="true"
                                         :close-on-select="true"
                                         :loading="isLoading"
                                         @search-change="asyncFindCustomer"
                                         track-by="id"
                                         label="name"
                                         placeholder="Nhập loại sản phẩm"
                                         selectLabel="Nhấn enter để chọn"
                                         deselectLabel = "Nhấn enter bor chọn"
                                         @input="updateCustomerSelected"></multiselect>
                            <label v-if="form.$errors.has('customer_id')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.customer_id[0]}}</label>
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
                    <div class="form-group" :class="{'has-error': form.$errors.has('tax')}">
                        <label class="col-sm-2 control-label">Tax (%)</label>
                        <div class="col-sm-8">
                            <input type="number" v-model="form.$fields.tax" class="form-control">
                            <label v-if="form.$errors.has('tax')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.tax[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ghi chú</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" v-model="form.$fields.description"></textarea>
                        </div>
                    </div>

                </form>
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
                                        <!--<th>Giảm Giá</th>-->
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
                isLoading :false,
                products : [],
                customers : [],
                payments : [],
                form: this.$form({
                    'customer_id': null,
                    'description': null,
                    'payment_type_id' : null,
                    'tax' : 0,
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
        computed : {
            'total' : function () {
                var fuck = 0;
                $.each(this.form.$fields.rows, function () {
                    var result =this.qty * this.price;
                    var discount = result/100 * this.discount;
                    result -= discount;
                    var tax = result/100 * this.tax;
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
                    price : '',
                });
            },
            subtotalItem : function (item) {
                return item.qty * item.price;
            },
            fetchData : function () {
                this.$Progress.start();
                this.$http.get('api/payment').then(function (response) {
                    this.payments = response.body;
                    this.$Progress.finish();
                }, function (response) {
                    this.$Progress.fail();
                })
            },
            asyncFindCustomer : function (query) {
                if (query.length === 0) {
                    this.customer = []
                } else {
                    this.isLoading = true
                    this.$http.get('api/customer/search/' + query).then(function (response) {
                        if (response.body === [])
                        {
                            console.log('empty')
                        }else{
                            this.customers = response.body;
                        }
                        this.isLoading = false;
                    }, function (response) {
                        this.isLoading = false;
                    });
                }
            },
            updateCustomerSelected (newSelected) {
                this.form.$fields.customer_id = newSelected
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
