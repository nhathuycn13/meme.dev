<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Update Customer #{{$route.params.id}}</h3>
        </div>
        <div class="panel-body">
            <div class="form form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name *</label>
                    <div class="col-sm-8">
                        <input type="text" v-model="item.name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Company Name </label>
                    <div class="col-sm-8">
                        <input type="text" v-model="item.company_name" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tax ID </label>
                    <div class="col-sm-8">
                        <input type="text" v-model="item.tax_id" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-8">
                        <input type="tel" v-model="item.phone" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Mobile</label>
                    <div class="col-sm-8">
                        <input type="tel" v-model="item.mobile" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Fax</label>
                    <div class="col-sm-8">
                        <input type="text" v-model="item.fax" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" v-model="item.email" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" v-model="item.address" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-8">
                        <textarea v-model="item.note" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        <button class="btn btn-primary" @click="updateItem">Update</button>
                        <router-link :to="{ name: 'list' }" class="btn btn-default">Back</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                item: {
                    name: '',
                    phone: '',
                    mobile: '',
                    email: '',
                    address: '',
                    tax_id: '',
                    description : '',
                    company_name : '',
                    fax : '',
                }
            }
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/customer/' + this.$route.params.id).then(function (response) {
                    this.item = response.body;
                })
            },
            updateItem : function () {
                this.$http.put('api/customer/' + this.$route.params.id, { 'data' : this.item}).then(function (response) {
                    this.notify('Success', 'success', 'Update complete!!!');
                }, function (response) {
                    if (response.status == 422){
                        var loop = response.body;
                        for(var item in loop){
                            this.notify('Error', 'danger', loop[item]);
                        }
                    }
                })
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
