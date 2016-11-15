<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
            </div>
            <div class="pull-left image">
                <img src="" class="img-circle" alt="User Image">
            </div>

        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            {{--<li class="header">Quản Lý Người Dùng</li>--}}
            {{--<li class="header">Quản Lý Bán Hàng</li>--}}
            <li>
                <a href="{{route('getDashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Quản Lý Bán Hàng</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('quoteManagement')}}"><i class="fa fa-circle-o"></i> Báo Gía</a></li>
                    <li><a href="{{route('orderManagement')}}"><i class="fa fa-circle-o"></i> đơn Hàng</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span>Quản Lý Kho</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('nkManagement')}}"><i class="fa fa-circle-o"></i> Nhập Kho</a></li>
                    <li><a href="{{route('xkManagement')}}"><i class="fa fa-circle-o"></i> Xuất Kho</a></li>
                    <li><a href="{{route('warehouseManagement')}}"><i class="fa fa-circle-o"></i> Kho Hàng</a></li>

                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-columns"></i>
                    <span>Quản Lý Sản Phẩm</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('productManagement')}}"><i class="fa fa-circle-o"></i> Sản Phẩm</a></li>
                    <li><a href="{{route('typeManagement')}}"><i class="fa fa-circle-o"></i> Loại Sản Phẩm</a></li>
                    <li><a href="{{route('manufacturerManagement')}}"><i class="fa fa-circle-o"></i> Hãng Sản Xuất</a></li>
                    <li><a href="{{route('customerManagement')}}"><i class="fa fa-circle-o"></i> Khách Hàng</a></li>
                    <li><a href="{{route('supplierManagement')}}"><i class="fa fa-circle-o"></i> Nhà Cung Cấp</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Quản Lý Người Dùng</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Test</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>