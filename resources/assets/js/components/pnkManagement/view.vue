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
                        <dd><timeago class="mailbox-date" :since="me.created_at" :auto-update="60"></timeago></dd>
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
                            <td>{{ item.product.name }}</td>
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
                                <th>Tất cả:</th>
                                <td>{{ total }} VND</td>
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

                    <button v-if="status.id == 1" @click="updateMe" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button v-if="status.id == 1" @click="deleteMe" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    <!--<button v-if="status.id != 1 && status.id != 3 && status.id != 4" @click="setToDone" type="button" class="btn btn-success"><i class="fa fa-check"></i>  đã nhập</button>-->


                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default"><i class="fa fa-print"></i> In</button>
                        <button type="button" class="btn btn-default" style="margin-right: 5px;">
                            <i class="fa fa-download"></i> Tải Về
                        </button>
                    </div>
                    <div class="btn-group pull-right">
                        <button type="button" class="dropdown-toggle" :class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Trạng thái: {{ status.name }} <span v-if="status.id != 3" class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" v-if="status.id == 4" @click.prevent="setStatus(1)">yêu cầu nhập</a>
                            </li>
                            <li>
                                <a href="#" v-if="status.id == 1" @click.prevent="setStatus(2)">đang đợi</a>
                            </li>
                            <li>
                                <a href="#" v-if="status.id == 2" @click.prevent="setStatus(3)">đã nhập</a>
                            </li>
                            <li>
                                <a href="#" v-if=" status.id != 3 && status.id != 4" @click.prevent="setStatus(4)"> Hủy</a>
                            </li>
                        </ul>
                    </div>
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
                btn : 'btn btn-default',
            }
        },
        created : function () {
            this.fetchData();
        },
        computed : {
            'total' : function () {
                var total = 0;
                $.each(this.ctpnk,function() {
                    total += parseInt(this.price) * this.qty;
                });
                return total;
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
                    this.btn = 'btn btn-' + this.status.label.split(" ")[1].split("-")[1];
                }, function (response) {
                    if (response.status == 404)
                        ;
                })
            },
            setStatus : function (status) {
                this.$http.put('api/nk/' + this.me.id, { setStatus : status }).then(function (response) {
//                    todoHuy : viet hoa this
                    this.notify('Success!', 'success', 'Updated!!!');
                    this.status = response.body;
                    this.btn = 'btn btn-' + this.status.label.split(" ")[1].split("-")[1];
                    console.log(response.body);

                }, function (response) {
//                    todoHuy : there
                    this.notify('Success!', 'success', 'Updated!!!');
                    console.log(response.body);
                });
            },
            deleteMe : function () {
                var confirm = window.confirm("Bạn có chắc muốn xóa?");
                if (!confirm) return;
                this.$Progress.start();
                this.$http.delete('api/nk/' + this.form.id).then(function (response) {
                    if (response.body == '1'){
                        this.notify('Deleted', 'success', '');
                        this.$router.push({ name: 'list'})
                        this.$Progress.finish();
                    }
                }, function () {
                    this.notify('Error', 'danger', '');
                    this.$Progress.fail();
                });
            },
            updateMe : function () {
                this.$router.push({ name: 'update', params : { id : this.$route.params.id}})
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
