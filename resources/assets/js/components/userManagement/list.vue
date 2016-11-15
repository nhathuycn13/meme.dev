<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>User Management</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="panel-footer">
            <router-link :to="{ name: 'add' }" class="btn btn-primary">Add User</router-link>
        </div>
    </div>
</template>
<script>
    export default{
        data : function () {
            return {};
        }
    }
</script>
