<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Add New Product</h3>
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
                    <label class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-8">
                        <select v-model="item.type_id" class="form-control">
                            <option v-for="type in types" v-bind:value="type.id">{{type.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Manufacturer</label>
                    <div class="col-sm-8">
                        <select v-model="item.manufacturer_id" class="form-control">
                            <option v-for="manu in manufacturers" v-bind:value="manu.id">{{manu.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Code </label>
                    <div class="col-sm-8">
                        <input type="text" v-model="item.code" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Thumbnail</label>
                    <div class="col-sm-3">
                        <input id="image" type="file" class="form-control" @change="loadImage">
                    </div>
                    <div class="col-sm-5">
                        <img id="imageLoad" class="img img-responsive img-thumbnail" @load="updateThumbnail"/>
                        <input id="ImageBase64" type="hidden" value="" v-model="item.thumbnail" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Detail</label>
                    <div class="col-sm-8">
                        <textarea v-model="item.detail" class="form-control"></textarea>
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
                item: {
                    name: '',
                    code: '',
                    detail: '',
                    type_id: '',
                    manufacturer_id: '',
                    thumbnail: '',
                },
                types : [],
                manufacturers : [],
            };
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            addNew : function () {
                this.$http.post('api/product', {'data' : this.item}).then(function (response) {
                    console.log(response.body);
                    this.notify('Success', 'success', 'Add complete!!!');
                    this.item = {
                        item: {
                            name: '',
                            code: '',
                            detail: '',
                            type_id: '',
                            manufacturer_id: '',
                            thumbnail: '',
                        }
                    }
                    document.getElementById('imageLoad').setAttribute('src', '');
                }, function (response) {
                    if (response.status == 422){
                        var loop = response.body;
                        for(var item in loop){
                            this.notify('Error', 'danger', loop[item]);
                        }
                    }
                });

            },
            fetchData : function () {
                this.$http.get('api/type').then(function (response) {
                    this.types = response.body;
                });
                this.$http.get('api/manufacturer').then(function (response) {
                    this.manufacturers = response.body;
                });
            },
            loadImage : function(){
                var input = document.getElementById('image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        document.getElementById('imageLoad').setAttribute('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);

                }

                this.item.thumbnail = document.getElementById('ImageBase64').getAttribute('value');

            },
            updateThumbnail : function () {
                this.item.thumbnail = document.getElementById('imageLoad').src;
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
