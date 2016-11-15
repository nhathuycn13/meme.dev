/**
 * Created by huy on 10/11/16.
 */
function myModule() {
    this.hello = function() {
        return 'hello!';
    }

    this.goodbye = function() {
        return 'goodbye!';
    }
    this.notify = function(title, type, text) {
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

        })
    }
}
module.exports = myModule;