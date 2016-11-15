<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Add New Product Type</h3>
        </div>
        <div class="panel-body">
            <div class="form form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name *</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" v-model="type.name" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-8">
                        <input type="text" name="code" v-model="type.code" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-8">
                        <textarea name="description" v-model="type.description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        <button class="btn btn-primary" @click="addNew">Add</button>
                        <router-link :to="{ name: 'list' }" class="btn btn-default">Back</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data : function () {
            return {
                type : {
                    name : '',
                    code : '',
                    description : '',
                }
            };
        },
        methods : {
            addNew : function () {
                this.$http.post('api/type', {'data' : this.type}).then(function (response) {
                    this.notify('Success', 'success', 'Add complete!!!');
                    this.type = {
                        name : "",
                        code : "",
                        description : "",
                    }
                }, function (response) {
                    if (response.status == 422){
                        var loop = response.body;
                        for(var item in loop){
                            this.notify('Error', 'danger', loop[item]);
                        }
                    }
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
