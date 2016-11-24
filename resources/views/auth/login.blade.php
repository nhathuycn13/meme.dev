<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>In 1 | Đăng Nhập</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        footer div{
            position: relative;
            right: 0px;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>In1 </b>Solution</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Đăng Nhập Hệ Thống</p>

            <form action="{{ route('postLogin') }}" method="post">
                {{ csrf_field()  }}
                <div class="form-group has-feedback">
                    <input name="email" autofocus class="form-control" placeholder="Tên tài khoản">
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Mật Khẩu">
                </div>
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-1">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Ghi nhớ
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng Nhập</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="#">Quên Mật Khẩu</a><br>

        </div>
        <!-- /.login-box-body -->

    </div>
    <!-- /.login-box -->
    <footer>
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2016 <a href="http://facebook.com/nhathuycn13">Huy Bui</a>.</strong> All rights
        reserved.
    </footer>
    <script src="{{asset('js/admin.js')}}"></script>
</body>
</html>
