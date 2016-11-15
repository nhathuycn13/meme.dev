<template>
    <div>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        Phiếu Nhập Kho
                        <div class="pull-right"><i class="fa fa-globe"></i> In1, Inc.</div>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <dl class="dl-horizontal">
                        <dt>Id:</dt>
                        <dd>#{{ me.id }}</dd>
                        <dt>Trạng thái:</dt>
                        <dd><span v-bind:class="status.label">{{ status.name }}</span></dd>
                        <dt>Ngày tạo:</dt>
                        <dd>{{ me.created_at }}</dd>
                        <dt>Nhân viên:</dt>
                        <dd>{{ user.name }}</dd>
                    </dl>
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá Nhập (VND)</th>
                            <th>Tổng cộng (VND)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in ctpnk">
                            <td>{{index+1}}</td>
                            <td>{{ getProduct(item.product_id) }}</td>
                            <td>{{ item.qty }}</td>
                            <td>{{ item.price }}</td>
                            <td> {{ item.qty * item.price }}</td>
                        </tr>
                        </tbody>
                    </table>
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
                            <tr>
                                <th style="width:50%">Tổng cộng:</th>
                                <td>{{ subtotal }} VND</td>
                            </tr>
                            <tr>
                                <th>Thuế ({{ me.tax }}%):</th>
                                <td>{{ toTax }} VND</td>
                            </tr>
                            <tr>
                                <th>Phí vận chuyển:</th>
                                <td>{{ me.shipping }} VND</td>
                            </tr>
                            <tr>
                                <th>Tất cả:</th>
                                <td>{{ toTotal }} VND</td>
                            </tr>
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
                    <button v-if="status.id != 1 && status.id != 3 && status.id != 4" @click="setToDone" type="button" class="btn btn-success"><i class="fa fa-check"></i> Trạng thái: đã nhập</button>
                    <button v-if="status.id != 2 && status.id != 3 && status.id != 4" @click="setToPending" type="button" class="btn btn-warning"><i class="fa fa-check"></i> Trạng thái: đang đợi</button>
                    <button v-if="status.id != 4 && status.id != 3" @click="setToCancel" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hủy</button>

                    <button type="button" class="btn btn-default pull-right"><i class="fa fa-print"></i> In</button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Tải Về
                    </button>
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
                status : '',
                ctpnk : [],
                list_products : [],
            }
        },
        created : function () {
            this.fetchData();
        },
        computed : {
            'subtotal' : function () {
                var total = 0;
                $.each(this.ctpnk,function() {
                    total += parseInt(this.price) * this.qty;
                });
                return total;
            },
            'toTax' : function () {
                return this.subtotal/100 * this.me.tax;
            },
            'toTotal' : function () {
                return this.subtotal + this.toTax + parseInt(this.me.shipping);
            },
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/nk/' + this.$route.params.id).then(function (response) {
                    this.me = response.body;
                    this.user = this.me.user;
                    this.status = this.me.status;
                    this.list_products = this.me.products;
                    this.ctpnk = this.me.c_t_p_n_ks;
                }, function (response) {
                    if (response.status == 404)
                        ;
                })
            },
            getProduct : function (_id) {
                return this.list_products.filter(function (product) {
                    return product.id === _id;
                })[0].name;
            },
            setToPending : function () {
                this.$http.put('api/nk/' + this.$route.params.id, {'setToPending' : true}).then(function (response) {
                    this.notify('Success!', 'success', 'Updated!!!');
                    this.status = response.body;
                    //console.log(response.body);
                }, function (response) {
                    console.log(response.body);
                });
            },
            setToDone : function () {
                this.$http.put('api/nk/' + this.$route.params.id, {'setToDone' : true}).then(function (response) {
                    this.notify('Success!', 'success', 'Updated!!!');
                    this.status = response.body;
                }, function (response) {
                    console.log(response.body);
                });
            },
            setToCancel : function () {
                this.$http.put('api/warehouse/nk/' + this.$route.params.id, {'setToCancel' : true}).then(function (response) {
                    this.notify('Success!', 'success', 'Updated!!!');
                    this.status = response.body;
                    //console.log(resonse.body);
                }, function (response) {
                    console.log(response.body);
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
