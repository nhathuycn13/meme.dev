<template>
    <div class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Thêm Mới Sản Phẩm
                    <div class="pull-right">
                        <i class="fa fa-globe"></i> In1, Inc.
                    </div>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form @submit.prevent="addNew" class="form form-horizontal">
                    <div class="form-group" :class="{'has-error': form.$errors.has('name')}">
                        <label class="col-sm-2 control-label">Tên *</label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.name" class="form-control">
                            <label v-if="form.$errors.has('name')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.name[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('type_id')}">
                        <label class="col-sm-2 control-label">Loại *</label>
                        <div class="col-sm-8">
                            <select v-model="form.$fields.type_id" class="form-control">
                                <option v-for="type in types" v-bind:value="type.id">{{type.name}}</option>
                            </select>
                            <label v-if="form.$errors.has('type_id')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.type_id[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('manufacturer_id')}">
                        <label class="col-sm-2 control-label">Nhà Sản Xuất *</label>
                        <div class="col-sm-8">
                            <select v-model="form.$fields.manufacturer_id" class="form-control">
                                <option v-for="manu in manufacturers" v-bind:value="manu.id">{{manu.name}}</option>
                            </select>
                            <label v-if="form.$errors.has('manufacturer_id')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.manufacturer_id[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('code')}">
                        <label class="col-sm-2 control-label">Mã *</label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.code" class="form-control">

                            <label v-if="form.$errors.has('code')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.code[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('thumbnail')}">
                        <label class="col-sm-2 control-label">Ảnh Đại Diện</label>
                        <div class="col-sm-3">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Chọn
                                <input id="image" type="file" class="form-control" @change="loadImage">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <label v-if="form.$errors.has('thumbnail')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.thumbnail[0]}}</label>
                            <img v-else id="imageLoad" class="img img-responsive img-thumbnail" @load="updateThumbnail"/>
                            <input id="ImageBase64" type="hidden" value="" v-model="form.$fields.thumbnail" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Chi Tiết</label>
                        <div class="col-sm-8">
                            <textarea v-model="form.$fields.detail" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <button :disabled="form.$busy" type="submit" class="btn btn-primary" @click="addNew"><i class="fa fa-save"></i> Lưu</button>
                            <router-link :to="{ name: 'list' }" class="btn btn-default"><i class="fa fa-mail-reply"></i> Quay Lại</router-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data : function () {
            return {
                form : this.$form({
                    name: '',
                    code: '',
                    detail: '',
                    type_id: '',
                    manufacturer_id: '',
                    thumbnail: '',
                }),
                types : [],
                manufacturers : [],
            };
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            addNew : function () {
                var meme = this;
                this.form.post('api/product').then(function (response) {
                    meme.notify('Thành công!', 'success', 'Add complete!!!');
                    meme.form.$fields = {
                        name: '',
                        code: '',
                        detail: '',
                        type_id: '',
                        manufacturer_id: '',
                        thumbnail: '',
                    }
                }, function (response) {
                    meme.notify('Thành công!', 'danger', 'Add complete!!!');

                });

            },
            fetchData : function () {
                this.$http.get('api/type').then(function (response) {
                    this.types = response.body.data;
                });
                this.$http.get('api/manufacturer').then(function (response) {
                    this.manufacturers = response.body.data;
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

                this.form.$fields.thumbnail = document.getElementById('ImageBase64').getAttribute('value');

            },
            updateThumbnail : function () {
                this.form.$fields.thumbnail = document.getElementById('imageLoad').src;
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
