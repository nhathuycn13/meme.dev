<template>
    <div class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Thêm Mới Nhà Cung Cấp
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
                    <div class="form-group" :class="{'has-error': form.$errors.has('company_name')}">
                        <label class="col-sm-2 control-label">Công Ty *</label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.company_name" class="form-control">

                            <label v-if="form.$errors.has('company_name')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.company_name[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('tax_id')}">
                        <label class="col-sm-2 control-label">Mã Số Thuế *</label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.tax_id" class="form-control">

                            <label v-if="form.$errors.has('tax_id')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.tax_id[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('phone')}">
                        <label class="col-sm-2 control-label">Điện Thoại </label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.phone" class="form-control">

                            <label v-if="form.$errors.has('phone')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.phone[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('mobile')}">
                        <label class="col-sm-2 control-label">Di Động </label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.mobile" class="form-control">

                            <label v-if="form.$errors.has('mobile')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.mobile[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('email')}">
                        <label class="col-sm-2 control-label">Email </label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.email" class="form-control">

                            <label v-if="form.$errors.has('email')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.email[0]}}</label>
                        </div>
                    </div>
                    <div class="form-group" :class="{'has-error': form.$errors.has('address')}">
                        <label class="col-sm-2 control-label">Địa Chỉ </label>
                        <div class="col-sm-8">
                            <input v-model="form.$fields.address" class="form-control">

                            <label v-if="form.$errors.has('address')" class="control-label"><i class="fa fa-times-circle-o"></i> {{form.$errors.$errors.address[0]}}</label>
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
    export default{
        data : function () {
            return {
                form : this.$form({
                    name: '',
                    phone: '',
                    mobile: '',
                    email: '',
                    address: '',
                    tax_id: '',
                    description : '',
                    company_name : ''
                }),
            };
        },
        methods : {
            addNew : function () {
                var meme = this;
                this.form.post('api/supplier').then(function (response) {
                    console.log(response.body);
                    meme.notify('Thành công!', 'success', 'Add complete!!!');
                    meme.form.$fields = {
                        name: '',
                        phone: '',
                        mobile: '',
                        email: '',
                        address: '',
                        tax_id: '',
                        description : '',
                        company_name : ''
                    }
                }, function (response) {

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
