<template>
    <div>
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        Chi tiết nhà sản xuất #MA
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

                    </dl>
                </div>
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
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
                nextId : null,
                previousId : null,
            }
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/manufacturer/' + this.$route.params.id).then(function (response) {
//                    console.log(response.body)
                }, function (response) {
                    if (response.status == 404)
                        ;
                })
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

