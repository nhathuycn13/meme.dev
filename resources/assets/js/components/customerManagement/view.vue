<template>
    <div>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <!---->
                        Chi tiết customer #C{{ getId(form.id) }}
                        <div class="pull-right">
                            <i class="fa fa-globe"></i> In1, Inc.
                            <div class="btn-group">
                                <!--<router-link v-if="previousId" :to="{ name:'view', params : { id : previousId} }" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></router-link>-->
                                <!--<router-link v-if="nextId" :to="{ name:'view', params : { id : nextId} }" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></router-link>-->
                            </div>
                        </div>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4">
                    <dl class="dl-horizontal">
                        <dt>Id</dt>
                        <dd>#MA{{ getId(form.id) }}</dd>

                        <dt>Tên</dt>
                        <dd>{{ form.name }}</dd>

                        <dt>Công Ty</dt>
                        <dd>{{ form.company_name }}</dd>

                        <dt>Mã Số Thuế</dt>
                        <dd>{{ form.tax_id }}</dd>
                    </dl>
                </div>
                <div class="col-sm-4">
                    <dl class="dl-horizontal">
                        <dt>Điện Thoại</dt>
                        <dd>{{ form.phone }}</dd>

                        <dt>Di Động</dt>
                        <dd>{{ form.mobile }}</dd>

                        <dt>Fax</dt>
                        <dd>{{ form.fax }}</dd>

                        <dt>Email</dt>
                        <dd><a :href="'mailto: ' + form.email">{{ form.email }}</a></dd>

                        <dt>Địa Chỉ</dt>
                        <dd>{{ form.address }}</dd>
                    </dl>
                </div>
                <div class="col-sm-4">
                    <dl class="dl-horizontal">
                        <dt>Ghi chú</dt>
                        <dd>{{ form.note }}</dd>
                    </dl>
                </div>
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
                    <button @click="updateMe" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button @click="deleteMe" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
                form : {

                }
            }
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/customer/' + this.$route.params.id).then(function (response) {
                    this.form = (response.body);
                }, function (response) {
                    if (response.status == 404)
                        ;
                })
            },
            getId : function (n) {
                n = n + '';
                return n.length >= 5 ? n : new Array(5 - n.length + 1).join('0') + n;
            },
            deleteMe : function () {
                var confirm = window.confirm("Bạn có chắc muốn xóa?");
                if (!confirm) return;
                this.$Progress.start();
                this.$http.delete('api/customer/' + this.form.id).then(function (response) {
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

