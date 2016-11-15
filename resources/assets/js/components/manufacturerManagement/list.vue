<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Manufacturer Management</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>

                <tr v-for="item in types">
                    <td>{{item.id}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.code}}</td>
                    <td>{{item.description}}</td>
                    <td>
                        <div class="btn-group">
                            <router-link :to="{ name: 'update', params: { id : item.id} }" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></router-link>
                            <button type="button" class="btn btn-primary" @click="deleteItem(item.id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="panel-footer">
            <router-link :to="{ name: 'add' }" class="btn btn-primary">Add New Type</router-link>
        </div>
    </div>
</template>
<script>
    export default{
        data : function () {
            return {
                types : []
            };
        },
        created: function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/manufacturer').then(function (response) {
                    this.types = response.body;
                });
            },
            deleteItem : function (id) {
                var confirm = window.confirm("Are you sure?");
                if (!confirm) return;
                this.$http.delete('api/manufacturer/' + id).then(function (response) {
                    if (response.body == '1'){
                        this.notify('Deleted', 'success', '');
                        this.fetchData();
                    }
                }, function () {
                    this.notify('Error', 'danger', '');
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
