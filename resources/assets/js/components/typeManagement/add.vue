<template>
    <div class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Thêm Mới Loại Sản Phẩm
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
                    <div class="form-group" :class="{'has-error': form.$errors.has('code')}">
                        <label class="col-sm-2 control-label">Mã *</label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.code" class="form-control">

                            <label v-if="form.$errors.has('code')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.code[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nha san xuat </label>
                        <div class="col-sm-8">
                            <multiselect :options="options"
                                         :value="form.$fields.manufacturer_ids"
                                         :multiple="true"
                                         :local-search="false"
                                         :clear-on-select="true"
                                         :close-on-select="false"
                                         :loading="isLoading"
                                         @select="dispatchAction"
                                         @search-change="asyncFind"
                                         track-by="id"
                                         label="name"
                                         placeholder="Nhập loại sản phẩm"
                                         selectLabel="Nhấn enter để chọn"
                                         deselectLabel = "Nhấn enter bor chọn"
                                         :custom-label="customerLabel"
                                         @input="updateSelected"></multiselect>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ghi chú</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" v-model="form.$fields.description"></textarea>
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
    import Multiselect from 'vue-multiselect'
    export default{
        data : function () {
            return {
                isLoading : false,
                options: [],
                form : this.$form({
                    name : '',
                    code : '',
                    manufacturer_ids : null,
                    description : '',
                }),
            };
        },
        components: {
            Multiselect,
        },
        methods : {
            addNew : function () {
                var meme = this;
                this.form.post('api/type').then(function (response) {
                    console.log(response.body);
                    meme.notify('Thành công!', 'success', 'Add complete!!!');
                    meme.form.$fields = {
                        name: '',
                        code: '',
                        description: '',
                    }
                }, function (response) {
                    meme.notify('Thành công!', 'danger', 'Add complete!!!');

                });

            },
            asyncFind : function (query) {
                if (query.length === 0) {
                    this.options = []
                } else {
                    this.isLoading = true
                    this.$http.get('api/manufacturer/search/' + query).then(function (response) {
                        console.log(response.body);
                        if (response.body === [])
                        {
                            console.log('empty')
                        }else{
                            this.options = response.body;
                        }
                        this.isLoading = false;
                    }, function (response) {
                        this.isLoading = false;
                    });
                }
            },
            updateSelected (newSelected) {
                this.form.$fields.type_id = newSelected
            },
            dispatchAction : function (actionName) {
                switch (actionName) {
                    case 'alert':
                        window.alert('You just dispatched "alert" action!')
                        break
                    case 'console.log':
                        console.log('You just dispatched "console.log" action!')
                        break
                    case 'scrollTop':
                        window.scrollTo(0, 0)
                        break
                }
            },
            customerLabel : function (meme) {
                return meme.name + '-' + meme.code;
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
