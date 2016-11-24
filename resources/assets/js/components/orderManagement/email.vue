<template>
    <div class="row">
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Gửi Mail Đơn Hàng</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label>To:</label>
                        <input class="form-control" v-model="customer_mail" placeholder="To:">
                    </div>
                    <div class="form-group">
                        <label>Cc:</label>
                        <input class="form-control" v-model="cc" placeholder="Cc:">
                    </div>
                    <div class="form-group">
                        <input class="form-control" v-model="subject" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                        <textarea v-model="content" id="compose-textarea" class="form-control" style="height: 300px"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Attachment
                            <input type="file" name="attachment">
                        </div>
                        <p class="help-block">Max. 32MB</p>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                        <button @click="sendMail" type="submit" class="btn btn-primary"><i :class="[isSendingMail ? 'fa fa-spinner fa-pulse fa-fw' : 'fa fa-paper-plane']"></i> Send</button>
                    </div>
                    <router-link :to="{ name: 'view', params : { id : $route.params.id} }" class="btn btn-default"><i class="fa fa-times"></i> Quay Lại</router-link>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                quote : '',
                customer_mail : '',
                cc : '',
                subject : '',
                content : '',
                attachment : '',
                isSendingMail : false,
            }
        },
        created : function () {
            this.fetchData();
        },
        methods : {
            fetchData : function () {
                this.$http.get('api/order/' + this.$route.params.id).then(function (response) {
                    this.quote = response.body.data;
                    this.customer_mail = this.quote.customer.email;

                    var n = this.quote.id + '';
                    var result = n.length >= 5 ? n : new Array(5 - n.length + 1).join('0') + n;
                    this.subject = 'Đơn Hàng #' + result;
                }, function (response) {
                    if (response.status == 404)
                        ;
                })
            },
            sendMail : function () {
                this.isSendingMail = true;
                var dataSent = {
                    customer : this.customer_mail,
                    subject : this.subject,
                    content : this.content,
                    cc : this.cc,
                }
                this.$http.put('api/quote/' + this.$route.params.id, {'sendMail' : true, 'data' : dataSent}).then(function (response) {
                    this.notify('Success!', 'success', 'Quote mail was sent!!!');
                    this.isSendingMail = false;
                }, function (response) {
                    this.notify('Error!', 'danger', 'Error occur while sending quote mail, please try again.');
                    this.isSendingMail = false;
                });
            },
            notify : function(title, type, text) {
                $.notify({
                    title : '<i class="fa fa-times" aria-hidden="true"></i> <strong>' + title + '</strong>',
                    icon : '',
                    message: '<br>' + text,
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
            },
        }
    }
</script>
