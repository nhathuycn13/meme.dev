<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Role Management</h3>
        </div>
        <div class="panel-body">
            <div class="form form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input v-model="newRole.name" type="text" name="name" class="form-control" placeholder="Enter name"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-8">
                        <input v-model="newRole.description" type="text" name="description" class="form-control" placeholder="Enter description"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Select Permissions</label>
                    <div class="col-sm-8">
                        <select class="form-control" multiple v-model="newRole.permissions">
                            <option v-for="permission in permissions">{{permission.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <router-link :to="{ name: 'add' }" class="btn btn-primary">Add User</router-link>
        </div>
    </div>
</template>

<script>
    export default{
        data : function () {
            return {
                newRole : {
                    name : '',
                    description : '',
                    permissions : [],
                },
                permissions : [],
            };
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/permission').then(function (response) {
                    this.permissions = response.body;
                });
            }
        }
    }
</script>
