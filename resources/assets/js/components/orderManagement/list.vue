<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Danh Sách đơn hàng</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Khách hàng</th>
                    <th>Nhân viên</th>
                    <th>Thời gian</th>
                    <th></th>
                </tr>

                <tr v-for="type in items">
                    <td>{{type.id}}</td>
                    <td>{{type.customer.name}}</td>
                    <td>{{type.user.name}}</td>
                    <td><timeago :since="type.created_at" :auto-update="60"></timeago></td>
                    <td>
                        <div class="btn-group">
                            <router-link :to="{ name: 'update', params: { id : type.id} }" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                            <router-link :to="{ name: 'view', params: { id : type.id} }" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></router-link>
                            <button type="button" class="btn btn-primary" @click="deleteItem(type.id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </td>
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
                var columns = ['name'];
                this.$http.get('api/order', {'columns' : columns}).then(function (response) {
                    this.items = response.body;
                    this.$Progress.finish()
                }, function (response) {
                    this.$Progress.fail()
                });
            },
            deleteItem : function (id) {
                var confirm = window.confirm("Are you sure?");
                if (!confirm) return;
                this.$Progress.start();
                this.$http.delete('api/order/' + id).then(function (response) {
                    this.$Progress.finish();
                    if (response.body == '1'){
                        this.notify('Deleted', 'success', '');
                        this.fetchData();
                    }
                }, function (response) {
                    this.notify('Error', 'danger', '');
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
