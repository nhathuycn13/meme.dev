<template>
    <div>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        Chi tiết đơn hàng #SO{{ getId(me.id) }}
                        <div class="pull-right">
                            <i class="fa fa-globe"></i> In1, Inc.
                            <div class="btn-group">
                                <router-link v-if="previousId" :to="{ name:'view', params : { id : previousId} }" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></router-link>
                                <router-link v-if="nextId" :to="{ name:'view', params : { id : nextId} }" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></router-link>
                            </div>
                        </div>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <dl class="dl-horizontal">
                        <dt>Id</dt>
                        <dd>#SO{{ getId(me.id) }}</dd>
                        <dt>Status</dt>
                        <dd>{{ type.name }}</dd>
                        <dt>Employee</dt>
                        <dd>{{ user.name }}</dd>
                    </dl>
                </div>
                <div class="col-sm-4 invoice-col">
                    <dl class="dl-horizontal">
                        <dt>Customer name</dt>
                        <dd>{{ customer.name }}</dd>
                        <dt>Phone</dt>
                        <dd>{{ customer.phone }}</dd>
                        <dt>Email</dt>
                        <dd><a :href="'mailto:' + customer.email">{{ customer.email }}</a></dd>
                    </dl>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Chi tiết</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Khác </a></li>
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
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr v-for="(item, index) in ctpnk">
                                        <td>
                                            {{index + 1}}
                                        </td>
                                        <td>
                                            {{ item.product.name }}
                                        </td>
                                        <td>
                                            {{ item.qty }}
                                        </td>
                                        <td>
                                            {{ item.price }}
                                        </td>
                                        <td>
                                            {{ item.discount }}
                                        </td>
                                        <td>
                                            {{ item.tax }}
                                        </td>
                                        <td>{{ subtotalItem(item) }}</td>
                                    </tr>
                                    </tbody>
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
                                                <td>{{ me.shipping }} VND</td>
                                            </tr>
                                            <tr>
                                                <th>Tất cả:</th>
                                                <td> {{ total + me.shipping }} VND</td>
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

                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <div v-show="me.description">
                        <p class="lead">Ghi chú:</p>

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            {{ me.description }}
                        </p>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead"></p>

                    <div class="table-responsive">
                        <table class="table">
                            <!--<tr>-->
                            <!--<th style="width:50%">Tổng cộng:</th>-->
                            <!--<td>{{ subtotal }} VND</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--<th>Thuế ({{ me.tax }}%):</th>-->
                            <!--<td>{{ toTax }} VND</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--<th>Phí vận chuyển:</th>-->
                            <!--<td>{{ me.shipping }} VND</td>-->
                            <!--</tr>-->
                            <!--<tr>-->
                            <!--<th>Tất cả:</th>-->
                            <!--<td>{{ toTotal }} VND</td>-->
                            <!--</tr>-->
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
                    <button v-if="type.id != 1" @click="setToCancel" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hủy</button>
                    <router-link :to="{ name: 'update', params : {id : $route.params.id} }" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh Sửa</router-link>
                    <button v-if="type.id != 2" class="btn btn-success" @click="setToQuote">Chuyển Thành bao gia</button>
                    <button v-if="type.id != 3" class="btn btn-success" @click="setToOrder">Chuyển Thành đơn hàng</button>
                    <button @click="printMe" type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> In</button>
                    <router-link :to="{ name: 'sendMail', params : {id : $route.params.id} }" class="btn btn-info pull-right"><i class="fa fa-envelope-o"></i> Send Mail</router-link>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
    export default{
        data(){
            return{
                me : '',
                user : '',
                type : '',
                ctpnk : [],
                customer : '',
                list_products : [],
                isSendingMail : false,
                nextId : null,
                previousId : null,
            }
        },
        created : function () {
            this.fetchData();
        },
        computed : {
            total : function () {
                var fuck = 0;
                $.each(this.ctpnk, function () {
                    var result =this.qty * this.price;
                    var discount = result/100 * this.discount;
                    result -= discount;
                    var tax = result/100 * this.tax;
                    //return result + tax;
                    fuck += result + tax;
                });
                return fuck;
            },
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/quote/' + this.$route.params.id).then(function (response) {
//                    console.log(response.body)
                    this.me = response.body.data;
                    this.user = this.me.user;
                    this.type = this.me.type;
                    this.list_products = this.me.products;
                    this.ctpnk = this.me.order_detail;
                    this.customer = this.me.customer;

                    // next and previous id
                    this.nextId = response.body.nextId;
                    this.previousId = response.body.previousId;
                }, function (response) {
                    if (response.status == 404)
                        ;
                })
            },

            subtotalItem : function (item) {
                var result =item.qty * item.price;
                var discount = result/100 * item.discount;
                result -= discount;
                var tax = result/100 * item.tax;
                return result + tax;
            },

            setToCancel : function () {
                this.$http.put('api/quote/' + this.$route.params.id, {'setToCancel' : true}).then(function (response) {
                    this.notify('Success!', 'success', 'Updated!!!');
                    this.type = response.body;
                }, function (response) {
                    console.log(response.body);
                });
            },
            setToQuote : function () {
                this.$http.put('api/quote/' + this.$route.params.id, {'setToQuote' : true}).then(function (response) {
                    this.notify('Success!', 'success', 'Updated!!!');
                    this.type = response.body;
                }, function (response) {
                    console.log(response.body);
                });
            },
            setToOrder : function () {
                this.$http.put('api/quote/' + this.$route.params.id, {'setToOrder' : true}).then(function (response) {
                    this.notify('Success!', 'success', 'Updated!!!');
                    this.type = response.body;
                }, function (response) {
                    console.log(response.body);
                });
            },
            getId : function (n) {
                n = n + '';
                return n.length >= 5 ? n : new Array(5 - n.length + 1).join('0') + n;
            },
            printMe : function () {
                this.$http.put('api/quote/' + this.$route.params.id, {'printMe' : true}).then(function (response) {
                    window.location.href = 'api/quote/' + this.$route.params.id + '/edit';
                }, function (response) {
                    console.log(response.body);
                    this.notify('Error!', 'danger', 'Error occur while sending quote mail, please try again.');
                });
            },
            notify : function(title, type, text) {
                $.notify({
                    title : '<i class="fa fa-times" aria-hidden="true"></i> <strong>' + title + '</strong>',
                    icon : '',
                    message: '<br>' + text,
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
            },
        },
    }
</script>
