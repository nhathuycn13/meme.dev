@extends('layout.master')

@section('title', 'Quản lý đơn hàng')

@section('content')
    <section class="content-header">
        <h1>
            Đơn Hàng
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>
    <router-view></router-view>
    <vue-progress-bar></vue-progress-bar>
@endsection

@push('script')
<script src="{{asset('js/order-management.js')}}"></script>
@endpush