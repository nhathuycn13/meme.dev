<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Add New Product Type</h3>
        </div>
        <div class="panel-body">
            <div class="form form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status *</label>
                    <div class="col-sm-8">
                        <select v-model="status_id" class="form-control">
                            <option v-for="s in list_status" v-bind:value="s.id">{{ s.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tax (%)</label>
                    <div class="col-sm-8">
                        <input type="number" v-model="tax" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Shipping</label>
                    <div class="col-sm-8">
                        <input type="number" v-model="shipping" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" v-model="description"></textarea>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel-body">
            <div>
                <div class="pull-right">
                    <button class="btn btn-primary" @click="addRow">Add Row</button>
                </div>
                <table class="table table-hover" id="meme">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="(item, index) in rows">
                        <td>
                            {{index + 1}}
                        </td>
                        <td>
                            <!--<selectMe :products="products" v-model="item.selected"></selectMe>-->
                            <select v-model="item.product_id" class="form-control" style="width : 100%;">
                                <option v-for="option in products" v-bind:value="option.id">{{option.name}}</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" v-model="item.qty" class="form-control">
                        </td>
                        <td>
                            <input type="text" v-model="item.price" class="form-control">
                        </td>
                        <td>
                            <a @click="rows.splice(index, 1)" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary" @click="updateItem">Update</button>
            <router-link :to="{ name: 'list' }" class="btn btn-default">Back</router-link>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                products : [],
                list_status : [],
                rows : [],
                status_id : 1,
                description : '',
                shipping : 0,
                tax : 0,
                ctpnk : [],
            };
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/product').then(function (response) {
                    this.products = response.body;
                })
                this.$http.get('api/status_nk').then(function (response) {
                    this.list_status = response.body;
                });
                this.$http.get('api/warehouse/nk/' + this.$route.params.id).then(function (response) {
//                    console.log(response.body);
                    this.status_id = response.body.status_id;
                    this.description = response.body.description;
                    this.shipping = response.body.shipping;
                    this.tax = response.body.tax;
                    this.rows = response.body.c_t_p_n_ks;
                }, function(response){
                    console.log(response.body);
                });
            },
            addRow : function () {
                this.rows.push({
                    product_id : -1,
                    qty : 1,
                    price : '',
                });
            },
            updateItem : function () {
                this.$http.put('api/type/' + this.$route.params.id, { 'data' : this.type}).then(function (response) {
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
