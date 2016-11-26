<template>
    <div>
        <!-- Main content -->
        <div class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        Chi tiết báo giá #SO{{ getId(me.id) }}
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
                        <dt>Id:</dt>
                        <dd>#SO{{ getId(me.id) }}</dd>
                        <dt>Status:</dt>
                        <dd><label :class="type.label">{{ type.name }}</label></dd>
                        <dt>Employee:</dt>
                        <dd>{{ user.name }}</dd>
                        <dt>Created At:</dt>
                        <dd><timeago :title="me.created_at" :since="me.created_at" :auto-update="60"></timeago></dd>
                    </dl>
                </div>
                <div class="col-sm-4 invoice-col">
                    <dl class="dl-horizontal">
                        <dt>Customer name:</dt>
                        <dd><a :href="'customer-management#/update/' + customer.id">{{ customer.name }}</a></dd>
                        <dt>Phone:</dt>
                        <dd>{{ customer.phone }}</dd>
                        <dt>Email:</dt>
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
                                        <td>{{ item.qty * item.price }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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
                                            <tr>
                                                <th>Tất cả:</th>
                                                <td> {{ total }} VND</td>
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
                    <div class="btn-group pull-right">
                        <button type="button" class="dropdown-toggle" :class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Trạng thái: {{ type.name }} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <!--<li>-->
                                <!--<a href="#" v-if="type.id == 2" @click.prevent="setStatus(1)">yêu cầu nhập</a>-->
                            <!--</li>-->
                            <!--<li>-->
                                <!--<a href="#" v-if="status.id == 1" @click.prevent="setStatus(2)">đang đợi</a>-->
                            <!--</li>-->
                            <!--<li>-->
                                <!--<a href="#" v-if="status.id == 2" @click.prevent="setStatus(3)">đã nhập</a>-->
                            <!--</li>-->
                            <li>
                                <a href="#" v-if="type.id != 1" @click.prevent="setStatus(1)"> Hủy</a>
                            </li>
                        </ul>
                    </div>
                    <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
                    <!--<button v-if="type.id != 1" @click="setToCancel" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hủy</button>-->
                    <!--<router-link :to="{ name: 'update', params : {id : $route.params.id} }" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh Sửa</router-link>-->
                    <!--<button v-if="type.id != 2" class="btn btn-success" @click="setToQuote">Chuyển Thành bao gia</button>-->
                    <!--<button v-if="type.id != 3" class="btn btn-success" @click="setToOrder">Chuyển Thành đơn hàng</button>-->
                    <button @click="printMe" type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> In</button>
                    <router-link :to="{ name: 'sendMail', params : {id : $route.params.id} }" class="btn btn-info pull-right"><i class="fa fa-envelope-o"></i> Send Mail</router-link>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
</template>
<script>
    export default{
        data(){
            return{
                me : {},
                user : {},
                type : {},
                ctpnk : [],
                customer : {},
                nextId : null,
                previousId : null,
                btn : 'btn btn-default',
            }
        },
        created : function () {
            this.fetchData();
        },
        computed : {
            total : function () {
                var fuck = 0;
                $.each(this.ctpnk, function () {
                    fuck += this.qty * this.price;
                });
                return fuck;
            },
        },
        methods : {
            fetchData : function () {
                this.$Progress.start();
                this.$http.get('api/quote/' + this.$route.params.id).then(function (response) {
                    this.$Progress.finish();
                    this.me = response.body;
                    this.user = this.me.user;
                    this.type = this.me.type;
                    this.ctpnk = this.me.order_detail;
                    this.customer = this.me.customer;
                    this.btn = 'btn btn-' + this.type.label.split(" ")[1].split("-")[1];
                }, function (response) {
                    if (response.status == 404)
                        ;
                    this.$Progress.fail();
                })
            },
            setStatus : function (status) {
                this.$http.put('api/quote/' + this.$route.params.id, {'status' : true}).then(function (response) {
                    this.notify('Success!', 'success', 'Updated!!!');
                    this.type = response.body;
                    this.btn = 'btn btn-' + this.type.label.split(" ")[1].split("-")[1];
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
