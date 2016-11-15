<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>User Management</h3>
        </div>
        <div class="panel-body">
            <div class="form form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" placeholder="Enter name"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" placeholder="Enter email"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" placeholder="Enter your password"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Re-Password</label>
                    <div class="col-sm-8">
                        <input type="password" name="repass" class="form-control" placeholder="Re-type your password"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Role</label>
                    <div class="col-sm-8">
                        <select class="form-control">
                            <option></option>
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
            return {};
        }
    }
</script>
