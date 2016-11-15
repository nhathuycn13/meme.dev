<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Kho Hàng</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Sản phẩm</th>
                    <th>Số luợng</th>
                    <th>Gía gốc</th>
                    <th>Lần nhập cuối</th>
                    <th></th>
                </tr>
                <tr v-for="(item, index) in items">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.product.name }}</td>
                    <td>{{ item.qty }}</td>
                    <td>{{ item.price }}</td>
                    <td><timeago :since="item.updated_at " :auto-update="60"></timeago></td>
                </tr>
                
            </table>
        </div>
        <div class="panel-footer">
            <router-link :to="{ name: 'add' }" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Thêm Mới</router-link>
        </div>
    </div>
</template>
<script>
    export default{
        data : function () {
            return {
                items : []
            };
        },
        created: function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$Progress.start();
                this.$http.get('api/warehouse').then(function (response) {
                    this.items = response.body;
                    this.$Progress.finish();
                }, function (response) {
                    this.$Progress.fail();
                });
            },
            notify : function(title, type, text) {
                $.notify({
                    title : '<i class="fa fa-times" aria-hidden="true"></i> <strong>' + title + '</strong>',
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
